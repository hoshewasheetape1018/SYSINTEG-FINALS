<?php

namespace App\Libraries;

use App\Models\CatalogCategoryModel;

class ProductCatalog
{
    private static bool $refreshAttempted = false;

    private const PRODUCTS = [
        1 => ['id' => 1, 'jotform_product_id' => '1000', 'name' => 'Spring (Stitched)', 'price' => 129.00, 'variants' => []],
        2 => ['id' => 2, 'jotform_product_id' => '1001', 'name' => 'Winter (Stitched)', 'price' => 129.00, 'variants' => []],
        3 => ['id' => 3, 'jotform_product_id' => '1002', 'name' => 'Autumn (Rivet)', 'price' => 129.00, 'variants' => []],
        4 => ['id' => 4, 'jotform_product_id' => '1003', 'name' => 'Summer', 'price' => 129.00, 'variants' => []],
        5 => ['id' => 5, 'jotform_product_id' => '1004', 'name' => 'Pink', 'price' => 129.00, 'variants' => []],
        6 => ['id' => 6, 'jotform_product_id' => '1005', 'name' => 'Black Pink', 'price' => 129.00, 'variants' => []],
        7 => ['id' => 7, 'jotform_product_id' => '1006', 'name' => 'Black Yellow', 'price' => 129.00, 'variants' => []],
        8 => ['id' => 8, 'jotform_product_id' => '1007', 'name' => 'Black', 'price' => 129.00, 'variants' => []],
        9 => ['id' => 9, 'jotform_product_id' => '1008', 'name' => 'Summer (Green Tint)', 'price' => 80.00, 'variants' => []],
        10 => ['id' => 10, 'jotform_product_id' => '1009', 'name' => 'Summer 2 (Spring Buckle)', 'price' => 60.00, 'variants' => []],
        11 => ['id' => 11, 'jotform_product_id' => '1010', 'name' => 'White (Bluish Tint)', 'price' => 80.00, 'variants' => ['Stitched', 'Rivet']],
        12 => ['id' => 12, 'jotform_product_id' => '1011', 'name' => 'Thomeowsian Lanyard (Old Stock)', 'price' => 60.00, 'variants' => []],
    ];

    public function all(bool $activeOnly = true): array
    {
        $database = db_connect();
        if (!$database->tableExists('catalog_products')) {
            return array_values(self::PRODUCTS);
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

        return $products === [] ? array_values(self::PRODUCTS) : array_map([$this, 'hydrateProduct'], $products);
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

        return self::PRODUCTS[$id] ?? null;
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
