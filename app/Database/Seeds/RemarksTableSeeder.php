<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RemarksTableSeeder extends Seeder
{
    private $table = 'remarks';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'remark' => 'Quality',
                'description' => 'Quality',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'remark' => 'Insufficient Cut Piece Supply',
                'description' => 'Insufficient Cut Piece Supply',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'remark' => 'Attendance',
                'description' => 'Attendance',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table($this->table)->insertBatch($data);
    }
}
