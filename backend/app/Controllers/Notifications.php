<?php
namespace App\Controllers;

use App\Models\NotificationModel;

class Notifications extends BaseController
{
    public function index()
    {
        $userId = $this->userId();
        if (!$userId) return redirect()->to('/login');

        return view('user/notifications', [
            'pageTitle' => 'Notifications',
            'notifications' => (new NotificationModel())
                ->where('user_id', $userId)
                ->orderBy('id', 'DESC')
                ->findAll(),
        ]);
    }

    public function markAsRead($id)
    {
        $userId = $this->userId();
        if (!$userId) return redirect()->to('/login');

        $model = new NotificationModel();
        $notification = $model->where('id', (int) $id)->where('user_id', $userId)->first();
        if (!$notification) return redirect()->to('/notifications');

        if (empty($notification['read_at'])) {
            $model->update((int) $id, ['read_at' => date('Y-m-d H:i:s')]);
        }
        return redirect()->to($notification['url'] ?: '/notifications');
    }

    public function markAllAsRead()
    {
        $userId = $this->userId();
        if (!$userId) return redirect()->to('/login');

        (new NotificationModel())
            ->where('user_id', $userId)
            ->where('read_at', null)
            ->set(['read_at' => date('Y-m-d H:i:s')])
            ->update();
        return redirect()->to('/notifications');
    }

    private function userId(): int
    {
        return session()->get('isLoggedIn') ? (int) session()->get('user_id') : 0;
    }
}
