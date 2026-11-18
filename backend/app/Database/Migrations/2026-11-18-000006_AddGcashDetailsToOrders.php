<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGcashDetailsToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'gcash_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'delivery_method'],
            'gcash_number' => ['type' => 'VARCHAR', 'constraint' => 11, 'null' => true, 'after' => 'gcash_name'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['gcash_name', 'gcash_number']);
    }
}
