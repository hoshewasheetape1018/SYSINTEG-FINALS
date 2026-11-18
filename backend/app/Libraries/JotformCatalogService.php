<?php

namespace App\Libraries;

use App\Models\CatalogCategoryModel;
use App\Models\CatalogProductModel;
use Config\Jotform;
use Config\Services;
use DOMDocument;
use DOMElement;
use DOMXPath;
use RuntimeException;

class JotformCatalogService
{
    private Jotform $config;
    private $http;

    public function __construct(?Jotform $config = null, $http = null)
    {
        $this->config = $config ?? config('Jotform');
        $this->http = $http ?? Services::curlrequest(['timeout' => 20, 'connect_timeout' => 5]);
    }

    /** @return array{categories:int,products:int,synced_at:string} */
    public function sync(): array
    {
        if ($this->config->formId === '') {
            throw new RuntimeException('Jotform form ID is not configured.');
        }

        $response = $this->http->get('https://form.jotform.com/' . rawurlencode($this->config->formId), [
            'headers' => ['Accept' => 'text/html'],
            'http_errors' => false,
        ]);
        if ($response->getStatusCode() >= 300) {
            throw new RuntimeException('The published Jotform could not be downloaded.');
        }

        $catalog = $this->parseCatalogHtml((string) $response->getBody());
        $syncedAt = date('Y-m-d H:i:s');
        $database = db_connect();
        $categories = new CatalogCategoryModel();
        $products = new CatalogProductModel();
        $categoryIds = [];

        $database->transStart();
        $database->table('catalog_categories')->update(['active' => 0]);
        $database->table('catalog_products')->update(['active' => 0]);

        foreach ($catalog['categories'] as $category) {
            $existing = $categories->where('jotform_category_id', $category['jotform_category_id'])->first();
            $data = $category + ['active' => 1, 'synced_at' => $syncedAt];
            if ($existing) {
                $categories->update((int) $existing['id'], $data);
                $categoryIds[$category['jotform_category_id']] = (int) $existing['id'];
            } else {
                $categoryIds[$category['jotform_category_id']] = (int) $categories->insert($data, true);
            }
        }

        foreach ($catalog['products'] as $product) {
            $categoryKey = $product['jotform_category_id'];
            unset($product['jotform_category_id']);
            $product['category_id'] = $categoryIds[$categoryKey] ?? null;
            $product['variants'] = json_encode($product['variants'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            $product['active'] = 1;
            $product['synced_at'] = $syncedAt;
            $existing = $products->where('jotform_product_id', $product['jotform_product_id'])->first();
            if ($existing) {
                $products->update((int) $existing['id'], $product);
            } else {
                $products->insert($product);
            }
        }

        $database->transComplete();
        if (!$database->transStatus()) {
            throw new RuntimeException('The Jotform catalog could not be saved.');
        }

        return [
            'categories' => count($catalog['categories']),
            'products' => count($catalog['products']),
            'synced_at' => $syncedAt,
        ];
    }

    /** @return array{categories:list<array<string,mixed>>,products:list<array<string,mixed>>} */
    public function parseCatalogHtml(string $html): array
    {
        if (trim($html) === '') {
            throw new RuntimeException('The published Jotform returned an empty page.');
        }

        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $loaded = $document->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        if (!$loaded) {
            throw new RuntimeException('The published Jotform could not be parsed.');
        }

        $xpath = new DOMXPath($document);
        $class = static fn (string $name): string => "contains(concat(' ', normalize-space(@class), ' '), ' {$name} ')";
        $categories = [];
        $categoryNodes = $xpath->query('//*[' . $class('form-product-category-item') . ' and @category]');
        foreach ($categoryNodes ?: [] as $node) {
            if (!$node instanceof DOMElement) continue;
            $jotformId = trim($node->getAttribute('category'));
            $labelNode = $xpath->query('.//strong', $node)?->item(0);
            $fullLabel = $this->cleanText($labelNode?->textContent ?? $node->textContent);
            [$name, $description] = $this->splitCategoryLabel($fullLabel);
            if ($jotformId !== '' && $name !== '') {
                $categories[$jotformId] = [
                    'jotform_category_id' => $jotformId,
                    'name' => $name,
                    'description' => $description,
                ];
            }
        }

        $products = [];
        $productNodes = $xpath->query('//*[' . $class('form-product-item') . ' and @pid]');
        foreach ($productNodes ?: [] as $node) {
            if (!$node instanceof DOMElement) continue;
            $jotformId = trim($node->getAttribute('pid'));
            $nameNode = $xpath->query('.//*[' . $class('form-product-name') . ']', $node)?->item(0);
            $priceNode = $xpath->query('.//*[@id="input_10_' . $jotformId . '_price"]', $node)?->item(0);
            $descriptionNode = $xpath->query('.//*[' . $class('form-product-description') . ']', $node)?->item(0);
            $imageNode = $xpath->query('.//img[contains(@alt, "Product Image")]', $node)?->item(0);
            $categoryKeys = preg_split('/[\s,]+/', trim($node->getAttribute('categories'))) ?: [];
            $variants = [];
            $variantNodes = $xpath->query('.//select[contains(@id, "_custom_")]/option', $node);
            foreach ($variantNodes ?: [] as $variantNode) {
                $variant = $this->cleanText($variantNode->textContent);
                if ($variant !== '') $variants[] = $variant;
            }

            $name = $this->cleanText($nameNode?->textContent ?? '');
            if ($jotformId === '' || $name === '' || !$priceNode) continue;
            $products[] = [
                'jotform_product_id' => $jotformId,
                'jotform_category_id' => $categoryKeys[0] ?? '',
                'name' => $name,
                'description' => $this->cleanText($descriptionNode?->textContent ?? '') ?: null,
                'price' => (float) str_replace(',', '', $this->cleanText($priceNode->textContent)),
                'image_url' => $imageNode instanceof DOMElement ? trim($imageNode->getAttribute('src')) : null,
                'variants' => array_values(array_unique($variants)),
            ];
        }

        if ($categories === [] || $products === []) {
            throw new RuntimeException('No Jotform product categories or products were found. Make sure the form is published and its Product List is visible.');
        }

        return ['categories' => array_values($categories), 'products' => $products];
    }

    /** @return array{0:string,1:?string} */
    private function splitCategoryLabel(string $label): array
    {
        if (preg_match('/^([^()]+?)\s*\((.+)\)$/s', $label, $matches)) {
            return [trim($matches[1]), trim($matches[2])];
        }
        return [$label, null];
    }

    private function cleanText(?string $value): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?? '');
    }
}
