<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'address' => ['type' => 'VARCHAR', 'constraint' => 255],
            'city' => ['type' => 'VARCHAR', 'constraint' => 100],
            'region' => ['type' => 'VARCHAR', 'constraint' => 100],
            'postal_code' => ['type' => 'VARCHAR', 'constraint' => 20],
            'delivery_method' => ['type' => 'VARCHAR', 'constraint' => 50],
            'subtotal' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'received'],
            'jotform_status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'pending'],
            'jotform_submission_id' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'jotform_error' => ['type' => 'TEXT', 'null' => true],
            'jotform_synced_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('orders');

        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'order_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'product_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'product_name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'variant' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'quantity' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'unit_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'line_total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('order_id');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items', true);
        $this->forge->dropTable('orders', true);
    }
}
