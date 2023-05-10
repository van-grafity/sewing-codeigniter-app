<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    private $table = 'groups';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'DS',
                'description' => 'Day Shift',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'NS',
                'description' => 'Night Shift',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table($this->table)->insertBatch($data);
    }
}
