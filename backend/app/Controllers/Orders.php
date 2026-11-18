<?php

namespace App\Controllers;

use App\Libraries\JotformService;
use App\Libraries\NotificationService;
use App\Libraries\ProductCatalog;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UsersModel;
use Throwable;

class Orders extends BaseController
{
    public function checkout()
    {
        $userId = (int) session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in before checking out.');
        }

        $items = $this->checkoutItems();
        if ($items === []) return redirect()->to('/cart')->with('error', 'Your cart is empty.');

        return view('orders/checkout', [
            'pageTitle' => 'Checkout',
            'user' => (new UsersModel())->find($userId),
            'items' => $this->checkoutItems(),
            'total' => $this->checkoutTotal(),
            'errors' => session()->getFlashdata('checkout_errors') ?? [],
            'old' => session()->getFlashdata('checkout_old') ?? [],
        ]);
    }

    public function create()
    {
        $userId = (int) session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in before placing an order.');
        }

        $post = $this->request->getPost();
        if ($this->checkoutItems() === []) return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        $validation = service('validation');
        $validation->setRules([
            'phone' => 'required|max_length[50]',
            'address' => 'required|max_length[255]',
            'city' => 'required|max_length[100]',
            'region' => 'required|max_length[100]',
            'postal_code' => 'required|max_length[20]',
            'delivery_method' => 'required|in_list[J&T (Metro Manila/Luzon) 1-3 items (₱85),J&T (Metro Manila/Luzon) 4 or more items (₱95),Lalamove (Contact us),Grab (Contact us)]',
            'payment_reference' => 'required|max_length[100]',
            'comments' => 'permit_empty|max_length[2000]',
        ]);

        if (!$validation->run($post)) {
            session()->setFlashdata('checkout_errors', $validation->getErrors());
            session()->setFlashdata('checkout_old', $post);
            return redirect()->to('/checkout');
        }

        $proof = $this->request->getFile('proof_of_payment');
        $allowedProofTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
        if (!$proof || !$proof->isValid() || $proof->hasMoved()) {
            return $this->checkoutError($post, ['proof_of_payment' => 'Please upload your proof of payment.']);
        }
        if ($proof->getSize() > 5 * 1024 * 1024 || !in_array($proof->getMimeType(), $allowedProofTypes, true)) {
            return $this->checkoutError($post, ['proof_of_payment' => 'Use a JPG, PNG, WebP, or PDF file no larger than 5 MB.']);
        }

        $uploadDirectory = WRITEPATH . 'uploads/payment-proofs';
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0775, true) && !is_dir($uploadDirectory)) {
            return redirect()->to('/checkout')->with('error', 'We could not store your proof of payment. Please try again.');
        }
        $proofName = $proof->getRandomName();
        $proof->move($uploadDirectory, $proofName);

        $database = db_connect();
        $database->transStart();
        $orderId = (new OrderModel())->insert([
            'user_id' => $userId,
            'phone' => trim((string) $post['phone']),
            'address' => trim((string) $post['address']),
            'city' => trim((string) $post['city']),
            'region' => trim((string) $post['region']),
            'postal_code' => trim((string) $post['postal_code']),
            'delivery_method' => $post['delivery_method'],
            'payment_reference' => trim((string) $post['payment_reference']),
            'proof_of_payment' => $proofName,
            'comments' => trim((string) ($post['comments'] ?? '')) ?: null,
            'subtotal' => $this->checkoutTotal(),
            'total' => $this->checkoutTotal(),
            'status' => 'received',
            'jotform_status' => 'pending',
        ], true);

        $items = [];
        foreach ($this->checkoutItems() as $item) {
            $item['order_id'] = $orderId;
            $items[] = $item;
        }
        (new OrderItemModel())->insertBatch($items);
        $database->transComplete();

        if (!$database->transStatus()) {
            @unlink($uploadDirectory . DIRECTORY_SEPARATOR . $proofName);
            return redirect()->to('/checkout')->with('error', 'We could not save your order. Please try again.');
        }

        (new NotificationService())->orderStatus([
            'id' => (int) $orderId,
            'user_id' => $userId,
        ], 'received');

        try {
            (new JotformService())->syncOrderById((int) $orderId);
        } catch (Throwable $exception) {
            // The local order is authoritative. Admins can retry Jotform later.
        }

        session()->remove('cart');

        return redirect()->to('/orders/confirmation/' . $orderId);
    }

    public function confirmation($id)
    {
        $data = $this->ownedOrder((int) $id);
        if ($data === null) {
            return redirect()->to('/profile/orders')->with('error', 'Order not found.');
        }
        return view('orders/confirmation', ['pageTitle' => 'Order confirmed'] + $data);
    }

    public function show($id)
    {
        $data = $this->ownedOrder((int) $id);
        if ($data === null) {
            return redirect()->to('/profile/orders')->with('error', 'Order not found.');
        }
        return view('orders/detail', ['pageTitle' => 'Order #' . $id] + $data);
    }

    private function checkoutItems(): array
    {
        return (new ProductCatalog())->cartItems(session()->get('cart') ?? []);
    }

    private function checkoutTotal(): float
    {
        return array_sum(array_column($this->checkoutItems(), 'line_total'));
    }

    private function checkoutError(array $old, array $errors)
    {
        session()->setFlashdata('checkout_errors', $errors);
        session()->setFlashdata('checkout_old', $old);
        return redirect()->to('/checkout');
    }

    private function ownedOrder(int $id): ?array
    {
        $userId = (int) session()->get('user_id');
        if (!$userId) {
            return null;
        }
        $order = (new OrderModel())->find($id);
        if (!$order || ((int) $order['user_id'] !== $userId && session()->get('type') !== 'admin')) {
            return null;
        }
        return [
            'orderId' => $id,
            'order' => $order,
            'items' => (new OrderItemModel())->where('order_id', $id)->findAll(),
        ];
    }
}
