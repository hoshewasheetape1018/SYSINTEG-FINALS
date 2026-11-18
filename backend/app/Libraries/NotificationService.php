<?php

namespace App\Libraries;

use App\Models\NotificationModel;

class NotificationService
{
    private const STATUS_MESSAGES = [
        'received' => 'Your order has been received and is waiting for review.',
        'approved' => 'Your order has been approved and is being prepared.',
        'shipped' => 'Your order has been shipped and is on its way.',
        'delivered' => 'Your order has been delivered. Thank you for shopping with Blumies!',
        'cancelled' => 'Your order has been cancelled. Please contact us if you need help.',
    ];

    public function orderStatus(array $order, string $status): void
    {
        if (!db_connect()->tableExists('notifications')) {
            log_message('warning', 'Notification skipped because the notifications table has not been migrated yet.');
            return;
        }

        if (!isset(self::STATUS_MESSAGES[$status])) {
            return;
        }

        $orderId = (int) ($order['id'] ?? 0);
        $userId = (int) ($order['user_id'] ?? 0);
        if ($orderId < 1 || $userId < 1) {
            return;
        }

        $model = new NotificationModel();
        $eventKey = "order:{$orderId}:{$status}";
        if ($model->where('event_key', $eventKey)->first()) {
            return;
        }

        $model->insert([
            'user_id' => $userId,
            'order_id' => $orderId,
            'event_key' => $eventKey,
            'title' => 'Order #' . $orderId . ' ' . ucfirst($status),
            'message' => self::STATUS_MESSAGES[$status],
            'url' => '/profile/orders/' . $orderId,
        ]);
    }
}
