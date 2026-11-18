<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UsersModel;

class AdminOrders extends BaseController
{
    private function guard()
    {
        return session()->get('isLoggedIn') && session()->get('type') === 'admin'
            ? null
            : redirect()->to('/')->with('error', 'You do not have access to that page.');
    }

    public function index()
    {
        if ($response = $this->guard()) return $response;

        $orders = (new OrderModel())
            ->select('orders.*, users.display_name, users.username, users.email')
            ->join('users', 'users.id = orders.user_id')
            ->orderBy('orders.id', 'DESC')
            ->findAll();

        return view('admin/orders', [
            'pageTitle' => 'Manage Orders',
            'orders' => $orders,
            'totalOrders' => count($orders),
            'newOrders' => count(array_filter($orders, static fn(array $order): bool => $order['status'] === 'received')),
            'completedOrders' => count(array_filter($orders, static fn(array $order): bool => $order['status'] === 'delivered')),
            'cancelledOrders' => count(array_filter($orders, static fn(array $order): bool => $order['status'] === 'cancelled')),
        ]);
    }

    public function show($id)
    {
        if ($response = $this->guard()) return $response;

        $order = (new OrderModel())->find((int) $id);
        if (!$order) return redirect()->to('/admin/orders')->with('error', 'Order not found.');

        return view('admin/order_detail', [
            'pageTitle' => 'Order #' . $id,
            'orderId' => (int) $id,
            'order' => $order,
            'user' => (new UsersModel())->find((int) $order['user_id']),
            'items' => (new OrderItemModel())->where('order_id', (int) $id)->findAll(),
        ]);
    }

    public function updateStatus($id)
    {
        if ($response = $this->guard()) return $response;

        $status = (string) $this->request->getPost('status');
        if (!in_array($status, ['received', 'approved', 'shipped', 'delivered', 'cancelled'], true)) {
            return redirect()->back()->with('error', 'Invalid order status.');
        }

        (new OrderModel())->update((int) $id, ['status' => $status]);
        return redirect()->to('/admin/orders/' . $id)->with('success', 'Order status updated.');
    }

    public function proof($id)
    {
        if ($response = $this->guard()) return $response;

        $order = (new OrderModel())->find((int) $id);
        if (!$order || empty($order['proof_of_payment'])) {
            return redirect()->to('/admin/orders/' . $id)->with('error', 'Proof of payment was not found.');
        }

        $fileName = basename((string) $order['proof_of_payment']);
        $path = WRITEPATH . 'uploads/payment-proofs/' . $fileName;
        if (!is_file($path)) {
            return redirect()->to('/admin/orders/' . $id)->with('error', 'Proof of payment was not found.');
        }

        return $this->response->download($path, null)->setFileName('order-' . (int) $id . '-proof.' . pathinfo($fileName, PATHINFO_EXTENSION));
    }
}
