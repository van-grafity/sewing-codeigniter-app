<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $table = 'users';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'email' => 'admin@ghimli.com',
                'password' => password_hash('ghimli@2024', PASSWORD_BCRYPT),
                'name' => 'Admin IT',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'email' => 'sewing@ghimli.com',
                'password' => password_hash('123456789', PASSWORD_BCRYPT),
                'name' => 'Sewing Clerk',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
