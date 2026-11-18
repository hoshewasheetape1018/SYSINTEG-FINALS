<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhoneToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true,
                'after' => 'email',
            ],
        ]);
        $this->db->query('CREATE UNIQUE INDEX users_phone_unique ON users (phone)');
    }

    public function down()
    {
        $this->db->query('DROP INDEX users_phone_unique ON users');
        $this->forge->dropColumn('users', 'phone');
    }
}
