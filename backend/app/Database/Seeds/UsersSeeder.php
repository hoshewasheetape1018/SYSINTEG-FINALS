<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // if you want password that is hashed
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $userPassword = password_hash('user123', PASSWORD_DEFAULT);

        $userData = [
            [
                'username'        => 'admin',
                'display_name'    => 'Administrator',
                'email'           => 'admin@genopals.com',
                'password_hash'   => $adminPassword,
                'coins'           => 9999,
                'type'            => 'admin',
                'account_status'  => 1,
                'email_activated' => 1,
                'profile_image'   => 'uploads/default_admin.png',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'username'        => 'testuser',
                'display_name'    => 'Test User',
                'email'           => 'user@genopals.com',
                'password_hash'   => $userPassword,
                'coins'           => 100,
                'type'            => 'client',
                'account_status'  => 1,
                'email_activated' => 0,
                'profile_image'   => 'uploads/default_user.png',
                'created_at'      => $now,
                'updated_at'      => $now,
            ]
        ];

        $this->db->table('users')->insertBatch($userData);
    }
}
