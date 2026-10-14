<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PetModel;

class AdminDashboard extends BaseController
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
