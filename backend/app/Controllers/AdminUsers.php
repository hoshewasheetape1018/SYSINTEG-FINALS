<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AdminUsers extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    private function isAdmin(): bool
    {
        return (bool) $this->session->get('isLoggedIn') && $this->session->get('type') === 'admin';
    }

    // List all users
    public function index()
    {
        if (!$this->isAdmin()) return redirect()->to('/')->with('error', 'You do not have access to that page.');
        $usersModel = new UsersModel();
        $users = $usersModel->orderBy('id', 'ASC')->findAll();

        return view('admin/manage_users', ['users' => $users]);
    }

    // Show edit form
    public function edit($id)
    {
        if (!$this->isAdmin()) return redirect()->to('/')->with('error', 'You do not have access to that page.');
        $usersModel = new UsersModel();
        $userEntity = $usersModel->find($id);

        if (!$userEntity) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        return view('admin/edit_user', ['user' => $userEntity]);
    }

    // Handle form submission
    public function update($id)
    {
        if (!$this->isAdmin()) return redirect()->to('/')->with('error', 'You do not have access to that page.');
        $usersModel = new UsersModel();
        $userEntity = $usersModel->find($id);

        if (!$userEntity) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        // Prepare data to update
        $updateData = [
            'username'       => $this->request->getPost('username'),
            'display_name'   => $this->request->getPost('display_name'),
            'email'          => $this->request->getPost('email'),
            'coins'          => (int) $this->request->getPost('coins'),
            'type'           => $this->request->getPost('type'),
            'account_status' => (int) $this->request->getPost('account_status'),
            'email_activated'=> (int) $this->request->getPost('email_activated'),
        ];

        // Optional password update
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $usersModel->update($id, $updateData);

        return redirect()->to('/admin/users')->with('success', 'User updated successfully.');
    }

    // Delete user
public function delete($id)
{
    if (!$this->isAdmin()) return redirect()->to('/')->with('error', 'You do not have access to that page.');
    $usersModel = new UsersModel();
    $userEntity = $usersModel->find($id);

    if (!$userEntity) {
        return redirect()->to('/admin/users')->with('error', 'User not found.');
    }

    // Prevent deleting self
    if ($id == $this->session->get('user_id')) {
        return redirect()->to('/admin/users')->with('error', 'You cannot delete your own account.');
    }

    $usersModel->delete($id);

    return redirect()->to('/admin/users')->with('success', 'User deleted successfully.');
}

}
