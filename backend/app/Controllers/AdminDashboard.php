<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PetModel;
use App\Models\CatalogProductModel;
use App\Models\OrderModel;

class AdminDashboard extends BaseController
{

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('type') !== 'admin') {
            return redirect()->to('/')->with('error', 'You do not have access to that page.');
        }

        $users = new UsersModel();
        $pets  = new PetModel();
        $orders = new OrderModel();

        $data = [
            'totalUsers'     => $users->countAll(),
            'activeUsers'    => $users->where('account_status', 1)->countAllResults(),
            'totalPets'      => $pets->countAll(),
            'totalSpecies'   => $pets->distinct()->countAllResults('species'),
            'totalProducts'  => (new CatalogProductModel())->where('active', 1)->countAllResults(),
            'totalOrders'    => $orders->countAll(),
            'newOrders'      => (new OrderModel())->where('status', 'received')->countAllResults(),
            'completedOrders'=> (new OrderModel())->where('status', 'delivered')->countAllResults(),
            'recentOrders'   => (new OrderModel())
                ->select('orders.*, users.display_name, users.username')
                ->join('users', 'users.id = orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->limit(5)
                ->findAll(),

            'popularSpecies' => $pets
                ->select('species, COUNT(*) as count')
                ->groupBy('species')
                ->orderBy('count', 'DESC')
                ->asArray()       // <-- prevent returning Entity objects
                ->findAll()
        ];

        return view('admin/dashboard', ['pageTitle' => 'Admin Dashboard'] + $data);
    }
}
