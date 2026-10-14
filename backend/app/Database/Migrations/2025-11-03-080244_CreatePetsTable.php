<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePetsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'species' => [
                'type'       => "ENUM('bunny','goat','fish')",
                'null'       => false,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'base_affection' => [
                'type'    => 'INT',
                'default' => 0,
                'null'    => false,
            ],
            'base_energy' => [
                'type'    => 'INT',
                'default' => 0,
                'null'    => false,
            ],
            'base_maintenance' => [
                'type'    => 'INT',
                'default' => 0,
                'null'    => false,
            ],
            'health' => [
                'type'    => 'INT',
                'default' => 100,
                'null'    => false,
            ],
            'energy' => [
                'type'    => 'INT',
                'default' => 100,
                'null'    => false,
            ],
            'hunger' => [
                'type'    => 'INT',
                'default' => 0,
                'null'    => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); // FK
        $this->forge->createTable('pets', true);
    }

    public function down()
    {
        $this->forge->dropTable('pets', true);
    }
}
