<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Local development credentials. Never use this password in production.
        $adminPassword = password_hash('123', PASSWORD_DEFAULT);
        $userPassword = password_hash('user123', PASSWORD_DEFAULT);

        $userData = [
            [
                'username'        => 'admin',
                'display_name'    => 'Administrator',
                'email'           => 'admin@blumies.test',
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
                'email'           => 'user@blumies.test',
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

        $users = $this->db->table('users');

        foreach ($userData as $user) {
            $existing = $users->where('username', $user['username'])->get()->getRowArray();

            if ($existing) {
                $users->where('id', $existing['id'])->update($user);
                continue;
            }

            $users->insert($user);
        }
    }
}
