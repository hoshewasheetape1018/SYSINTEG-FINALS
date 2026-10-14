<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Authentication extends BaseController
{
    public function login()
    {
        $session = session();

        return view('auth/login', [
            'errors'  => $session->getFlashdata('login_errors') ?? [],
            'old'     => $session->getFlashdata('login_old') ?? [],
            'success' => $session->getFlashdata('success') ?? null, // for signup success
        ]);
    }

    public function loginPost()
    {
        $session = session();
        $post = $this->request->getPost();
        $errors = [];

        if (empty($post['username'])) {
            $errors['username'] = 'Username is required';
        }
        if (empty($post['password'])) {
            $errors['password'] = 'Password is required';
        }

        if (!empty($errors)) {
            $session->setFlashdata('login_errors', $errors);
            $session->setFlashdata('login_old', $post);
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $user = $userModel->where('username', $post['username'])->first();

        if (!$user) {
            $errors['username'] = 'No account found with that username';
            $session->setFlashdata('login_errors', $errors);
            $session->setFlashdata('login_old', ['username' => $post['username']]);
            return redirect()->back()->withInput();
        }

        // If $user is an entity, convert to array
        $userArr = is_array($user) ? $user : $user->toArray();

        if (!password_verify($post['password'], $userArr['password_hash'] ?? '')) {
            $errors['password'] = 'Incorrect password';
            $session->setFlashdata('login_errors', $errors);
            $session->setFlashdata('login_old', ['username' => $post['username']]);
            return redirect()->back()->withInput();
        }

        // LOGIN
        $session->set([
            'user_id'      => $userArr['id'],
            'username'     => $userArr['username'],
            'display_name' => $userArr['display_name'],
            'email'        => $userArr['email'],
            'type'         => $userArr['type'] ?? 'client',
            'isLoggedIn'   => true,
        ]);

        // Redirect based on role
        return strtolower($userArr['type'] ?? 'client') === 'admin'
            ? redirect()->to('/admin/dashboard')
            : redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'] ?? '/', $params['domain'] ?? '', isset($_SERVER['HTTPS']), true);
        return redirect()->to('/');
    }

    public function signup()
    {
        helper(['form']);
        return view('auth/signup');
    }

    public function signupPost()
    {
        helper(['form']);
        $post = $this->request->getPost();

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'display_name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if (!$validation->run($post)) {
            session()->setFlashdata('signup_errors', $validation->getErrors());
            session()->setFlashdata('signup_old', $post);
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $data = [
            'username'        => $post['username'],
            'display_name'    => $post['display_name'],
            'email'           => $post['email'],
            'password_hash'   => password_hash($post['password'], PASSWORD_DEFAULT),
            'coins'           => 0,
            'type'            => 'client',
            'account_status'  => 1,
            'email_activated' => 0,
        ];

        if (!$userModel->insert($data)) {
            $errors = $userModel->errors() ?: ['general' => 'Failed to create account. Please try again later.'];
            session()->setFlashdata('signup_errors', $errors);
            session()->setFlashdata('signup_old', $post);
            return redirect()->back()->withInput();
        }

        return redirect()->to('/login')->with('success', 'Account created successfully! You can now log in.');
    }
}
