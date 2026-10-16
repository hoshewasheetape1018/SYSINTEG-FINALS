<?php

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\UsersModel;

class AdminPets extends BaseController
{

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('type') !== 'admin') {
            return redirect()->to('/')->with('error', 'You do not have access to that page.');
        }

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
