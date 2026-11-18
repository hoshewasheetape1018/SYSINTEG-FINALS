<?php

namespace App\Controllers;

use App\Libraries\ProductCatalog;

class Cart extends BaseController
{
    public function index()
    {
        $items = (new ProductCatalog())->cartItems(session()->get('cart') ?? []);
        return view('shop/cart', [
            'pageTitle' => 'Shopping Cart',
            'items' => $items,
            'total' => array_sum(array_column($items, 'line_total')),
        ]);
    }

    public function add()
    {
        $productId = (int) $this->request->getPost('product_id');
        $product = (new ProductCatalog())->find($productId);
        if (!$product) return redirect()->to('/products')->with('error', 'Product not found.');

        $cart = session()->get('cart') ?? [];
        $quantity = min(10, max(1, (int) $this->request->getPost('quantity')));
        $variant = (string) $this->request->getPost('variant');
        $allowedVariants = $product['variants'] ?? [];
        if ($allowedVariants !== [] && !in_array($variant, $allowedVariants, true)) {
            return redirect()->to('/products/' . $productId)->with('error', 'Please choose a valid product type.');
        }
        $cart[$productId] = [
            'quantity' => min(10, (int) ($cart[$productId]['quantity'] ?? 0) + $quantity),
            'variant' => $allowedVariants === [] ? '' : $variant,
        ];
        session()->set('cart', $cart);

        return redirect()->to('/cart')->with('success', $product['name'] . ' was added to your cart.');
    }

    public function update()
    {
        $cart = session()->get('cart') ?? [];
        foreach ((array) $this->request->getPost('quantities') as $productId => $quantity) {
            if (isset($cart[$productId])) $cart[$productId]['quantity'] = min(10, max(1, (int) $quantity));
        }
        session()->set('cart', $cart);
        return redirect()->to('/cart')->with('success', 'Cart updated.');
    }

    public function remove()
    {
        $cart = session()->get('cart') ?? [];
        unset($cart[(int) $this->request->getPost('product_id')]);
        session()->set('cart', $cart);
        return redirect()->to('/cart');
    }

    public function clear()
    {
        session()->remove('cart');
        return redirect()->to('/cart');
    }
}
