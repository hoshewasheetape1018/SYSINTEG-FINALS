<?php
namespace App\Controllers;
class AdminOrders extends BaseController
{
    private function guard() { return session()->get('isLoggedIn') && session()->get('type') === 'admin' ? null : redirect()->to('/')->with('error', 'You do not have access to that page.'); }
    public function index() { if ($r=$this->guard()) return $r; return view('admin/orders', ['pageTitle' => 'Manage Orders']); }
    public function show($id) { if ($r=$this->guard()) return $r; return view('admin/order_detail', ['pageTitle' => 'Order #' . $id, 'orderId' => $id]); }
    public function updateStatus($id) { if ($r=$this->guard()) return $r; return redirect()->to('/admin/orders/' . $id)->with('success', 'Order status updated.'); }
}
