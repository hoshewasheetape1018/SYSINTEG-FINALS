<?php

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\UsersModel;

class AdminPets extends BaseController
{

        public function __construct()
    {
        $session = session();

        // Check if user is logged in and is admin
        if (!$session->get('isLoggedIn') || $session->get('type') !== 'admin') {
            $session->setFlashdata('error', 'Error: You do not have access to the page.');
            return redirect()->to('/')->send(); // Redirect to landing page
        }
    }


    public function index()
    {
        $pets = new PetModel();

        // Join users so admin can see the owner name
        $data = [
            'pets' => $pets
                ->select('pets.*, users.username')
                ->join('users', 'users.id = pets.user_id')
                ->asArray()
                ->findAll()
        ];

        return view('admin/manage_pets', $data);
    }
}
