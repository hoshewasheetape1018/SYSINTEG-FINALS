<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'order_id', 'product_id', 'product_name', 'variant',
        'quantity', 'unit_price', 'line_total',
    ];
}
