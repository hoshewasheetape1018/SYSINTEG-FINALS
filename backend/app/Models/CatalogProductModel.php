<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogProductModel extends Model
{
    protected $table = 'catalog_products';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'jotform_product_id', 'category_id', 'name', 'description', 'price',
        'image_url', 'variants', 'active', 'synced_at',
    ];
}
