<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'order_id' => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'event_key' => ['type' => 'VARCHAR', 'constraint' => 120],
            'title' => ['type' => 'VARCHAR', 'constraint' => 150],
            'message' => ['type' => 'VARCHAR', 'constraint' => 500],
            'url' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => '/notifications'],
            'read_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('event_key');
        $this->forge->addKey(['user_id', 'read_at']);
        $this->forge->addKey('order_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications', true);
    }
}
