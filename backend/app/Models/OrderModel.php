<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'phone', 'address', 'city', 'region', 'postal_code',
        'delivery_method', 'gcash_name', 'gcash_number', 'payment_reference', 'proof_of_payment', 'comments',
        'subtotal', 'total', 'status',
        'jotform_status', 'jotform_submission_id', 'jotform_error', 'jotform_synced_at',
    ];
}
