<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogCategoryModel extends Model
{
    protected $table = 'catalog_categories';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'jotform_category_id', 'name', 'description', 'active', 'synced_at',
    ];
}
