<?php

namespace App\Commands;

use App\Libraries\JotformCatalogService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SyncJotformCatalog extends BaseCommand
{
    protected $group = 'Catalog';
    protected $name = 'catalog:sync';
    protected $description = 'Synchronize products and categories from the published Jotform.';

    public function run(array $params)
    {
        $result = (new JotformCatalogService())->sync();
        CLI::write(sprintf(
            'Synchronized %d categories and %d products at %s.',
            $result['categories'],
            $result['products'],
            $result['synced_at']
        ), 'green');
    }
}
