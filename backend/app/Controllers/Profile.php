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

        $post = $this->request->getPost();
        $validation = service('validation');
        $validation->setRules([
            'username' => 'required|regex_match[/^[A-Za-z0-9_]{3,30}$/]|is_unique[users.username,id,' . (int) $userId . ']',
            'display_name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|max_length[255]|valid_email|is_unique[users.email,id,' . (int) $userId . ']',
            'phone' => 'required|regex_match[/^09[0-9]{9}$/]|is_unique[users.phone,id,' . (int) $userId . ']',
            'password' => 'permit_empty|min_length[8]|max_length[72]',
        ], [
            'username' => ['regex_match' => 'Use 3–30 letters, numbers, or underscores.'],
            'phone' => ['regex_match' => 'Enter an 11-digit Philippine mobile number starting with 09.'],
        ]);

        if (!$validation->run($post)) {
            session()->setFlashdata('profile_errors', $validation->getErrors());
            session()->setFlashdata('profile_old', $post);
            return redirect()->to('/profile/settings');
        }

        $data = [
            'username'     => trim((string) $post['username']),
            'display_name' => trim((string) $post['display_name']),
            'email'        => strtolower(trim((string) $post['email'])),
            'phone'        => trim((string) $post['phone']),
        ];

        // Password change (optional)
        $newPassword = $post['password'] ?? '';

        if (!empty($newPassword)) {
            $data['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $UsersModel->skipValidation(true)->update($userId, $data);
        session()->set([
            'username' => $data['username'],
            'display_name' => $data['display_name'],
            'email' => $data['email'],
        ]);

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
