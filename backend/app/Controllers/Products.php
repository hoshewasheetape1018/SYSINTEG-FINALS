<?php
namespace App\Controllers;
class Products extends BaseController
{
    public function index() { return view('shop/products', ['pageTitle' => 'Shop']); }
    public function show($id) { return view('shop/product', ['pageTitle' => 'Product details', 'productId' => $id]); }
}
