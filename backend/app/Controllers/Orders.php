<?php
namespace App\Controllers;
class Orders extends BaseController
{
    public function checkout() { return view('orders/checkout', ['pageTitle' => 'Checkout']); }
    public function create() { return redirect()->to('/orders/confirmation/1001'); }
    public function confirmation($id) { return view('orders/confirmation', ['pageTitle' => 'Order confirmed', 'orderId' => $id]); }
    public function show($id) { return view('orders/detail', ['pageTitle' => 'Order #' . $id, 'orderId' => $id]); }
}
