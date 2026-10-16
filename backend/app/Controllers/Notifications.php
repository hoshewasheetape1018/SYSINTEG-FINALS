<?php
namespace App\Controllers;
class Notifications extends BaseController
{
    public function index() { return view('user/notifications', ['pageTitle' => 'Notifications']); }
    public function markAsRead($id) { return redirect()->to('/notifications'); }
    public function markAllAsRead() { return redirect()->to('/notifications'); }
}
