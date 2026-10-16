<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PetModel;

class AdminDashboard extends BaseController
{

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('type') !== 'admin') {
            return redirect()->to('/')->with('error', 'You do not have access to that page.');
        }

        $users = new UsersModel();
        $pets  = new PetModel();

        $data = [
            'totalUsers'     => $users->countAll(),
            'activeUsers'    => $users->where('account_status', 1)->countAllResults(),
            'totalPets'      => $pets->countAll(),
            'totalSpecies'   => $pets->distinct()->countAllResults('species'),

            'popularSpecies' => $pets
                ->select('species, COUNT(*) as count')
                ->groupBy('species')
                ->orderBy('count', 'DESC')
                ->asArray()       // <-- prevent returning Entity objects
                ->findAll()
        ];

        return view('admin/dashboard', $data);
    }
}
