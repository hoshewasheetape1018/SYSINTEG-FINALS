<?php
namespace App\Controllers;
class Cart extends BaseController
{
    public function index() { return view('shop/cart', ['pageTitle' => 'Shopping Cart']); }
    public function add() { return redirect()->to('/cart')->with('success', 'Item added to your cart.'); }
    public function update() { return redirect()->to('/cart'); }
    public function remove() { return redirect()->to('/cart'); }
    public function clear() { return redirect()->to('/cart'); }
}
