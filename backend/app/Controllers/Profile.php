<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PetModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;

class Profile extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $UsersModel = new UsersModel();
        $user = $UsersModel->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        // Use PetModel instead of raw DB query
        $PetModel = new PetModel();
        $pets = $PetModel->where('user_id', $userId)->findAll(); // <- will ignore soft-deleted pets automatically

        return view('user/profile', [
            'user' => $user,
            'pets' => $pets
        ]);
    }


    public function settings()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $UsersModel = new UsersModel();
        $user = $UsersModel->find($userId);

        return view('user/settings', ['user' => $user]);
    }

    public function updateSettings()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $UsersModel = new UsersModel();
        $user = $UsersModel->find($userId);

        if (!$user) {
            return redirect()->to('/profile/settings')->with('error', 'User not found.');
        }

        // Base fields user can change
        $data = [
            'username'     => $this->request->getPost('username'),
            'display_name' => $this->request->getPost('display_name'),
            'email'        => $this->request->getPost('email'),
            'avatar'       => $this->request->getPost('avatar'),
        ];

        // Password change (optional)
        $newPassword = $this->request->getPost('password');

        if (!empty($newPassword)) {
            $data['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $UsersModel->update($userId, $data);

        return redirect()->to('/profile/settings')->with('message', 'Profile updated successfully!');
    }

    public function orders()
    {
        $userId = (int) session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        return view('user/orders', [
            'pageTitle' => 'My Orders',
            'orders' => (new OrderModel())->where('user_id', $userId)->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function order($id)
    {
        $userId = (int) session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $order = (new OrderModel())->find((int) $id);
        if (!$order || (int) $order['user_id'] !== $userId) {
            return redirect()->to('/profile/orders')->with('error', 'Order not found.');
        }

        return view('orders/detail', [
            'pageTitle' => 'Order #' . $id,
            'orderId' => (int) $id,
            'order' => $order,
            'items' => (new OrderItemModel())->where('order_id', (int) $id)->findAll(),
        ]);
    }
}
