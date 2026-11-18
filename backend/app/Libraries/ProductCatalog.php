<?php

namespace App\Libraries;

class ProductCatalog
{
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

    public function all(): array
    {
        return array_values(self::PRODUCTS);
    }

    public function find(int $id): ?array
    {
        return self::PRODUCTS[$id] ?? null;
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
}
