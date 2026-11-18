<?php

namespace App\Controllers;

use App\Libraries\ProductCatalog;

class Products extends BaseController
{
    public function index()
    {
        return view('shop/products', ['pageTitle' => 'Shop', 'products' => (new ProductCatalog())->all()]);
    }

    public function show($id)
    {
        $product = (new ProductCatalog())->find((int) $id);
        if (!$product) return redirect()->to('/products')->with('error', 'Product not found.');
        return view('shop/product', ['pageTitle' => $product['name'], 'product' => $product, 'productId' => (int) $id]);
    }
}
