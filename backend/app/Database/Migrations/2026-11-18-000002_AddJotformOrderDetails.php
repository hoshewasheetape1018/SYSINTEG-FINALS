<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJotformOrderDetails extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'phone' => ['type' => 'VARCHAR', 'constraint' => 50, 'after' => 'user_id'],
            'payment_reference' => ['type' => 'VARCHAR', 'constraint' => 100, 'after' => 'delivery_method'],
            'proof_of_payment' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'payment_reference'],
            'comments' => ['type' => 'TEXT', 'null' => true, 'after' => 'proof_of_payment'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['phone', 'payment_reference', 'proof_of_payment', 'comments']);
    }
}
