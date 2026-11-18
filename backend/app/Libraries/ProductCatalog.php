<?php

namespace App\Libraries;

use App\Models\CatalogCategoryModel;

class ProductCatalog
{
    private static bool $refreshAttempted = false;

    public function all(bool $activeOnly = true): array
    {
        $database = db_connect();
        if (!$database->tableExists('catalog_products')) {
            return [];
        }
        $this->refreshIfStale();

        $builder = $database->table('catalog_products products')
            ->select('products.*, categories.name AS category_name')
            ->join('catalog_categories categories', 'categories.id = products.category_id', 'left')
            ->orderBy('categories.id', 'ASC')
            ->orderBy('products.id', 'ASC');
        if ($activeOnly) {
            $builder->where('products.active', 1)->groupStart()
                ->where('categories.active', 1)->orWhere('products.category_id', null)
                ->groupEnd();
        }
        $products = $builder->get()->getResultArray();

        return array_map([$this, 'hydrateProduct'], $products);
    }

    public function find(int $id): ?array
    {
        $database = db_connect();
        if ($database->tableExists('catalog_products')) {
            $this->refreshIfStale();
            $product = $database->table('catalog_products products')
                ->select('products.*, categories.name AS category_name')
                ->join('catalog_categories categories', 'categories.id = products.category_id', 'left')
                ->where('products.id', $id)
                ->where('products.active', 1)
                ->get()->getRowArray();
            if ($product) return $this->hydrateProduct($product);
        }

        return null;
    }

    public function byCategory(int $categoryId): array
    {
        return array_values(array_filter(
            $this->all(),
            static fn (array $product): bool => (int) ($product['category_id'] ?? 0) === $categoryId
        ));
    }

    public function categories(bool $activeOnly = true): array
    {
        $database = db_connect();
        if (!$database->tableExists('catalog_categories')) return [];
        $this->refreshIfStale();

        $model = new CatalogCategoryModel();
        if ($activeOnly) $model->where('active', 1);
        return $model->orderBy('id', 'ASC')->findAll();
    }

    public function cartItems(array $cart): array
    {
        $items = [];
        foreach ($cart as $productId => $selection) {
            $product = $this->find((int) $productId);
            if (!$product) continue;

            $quantity = max(1, (int) ($selection['quantity'] ?? 1));
            $items[] = [
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'variant' => (string) ($selection['variant'] ?? ''),
                'quantity' => $quantity,
                'unit_price' => $product['price'],
                'line_total' => $quantity * $product['price'],
            ];
        }
        return $items;
    }

    private function hydrateProduct(array $product): array
    {
        $decoded = json_decode((string) ($product['variants'] ?? '[]'), true);
        $product['variants'] = is_array($decoded) ? array_values(array_map('strval', $decoded)) : [];
        $product['price'] = (float) $product['price'];
        return $product;
    }

    private function refreshIfStale(): void
    {
        if (self::$refreshAttempted) return;
        self::$refreshAttempted = true;

        $database = db_connect();
        $row = $database->table('catalog_products')->selectMax('synced_at', 'latest_sync')->get()->getRowArray();
        $latestSync = !empty($row['latest_sync']) ? strtotime((string) $row['latest_sync']) : false;
        $ttl = max(60, (int) env('JOTFORM_CATALOG_SYNC_TTL', 900));
        if ($latestSync !== false && $latestSync >= time() - $ttl) return;

        try {
            (new JotformCatalogService())->sync();
        } catch (\Throwable $exception) {
            log_message('warning', 'Automatic Jotform catalog refresh failed; cached catalog retained: {message}', [
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
