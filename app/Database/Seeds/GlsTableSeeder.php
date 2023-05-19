<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GlsTableSeeder extends Seeder
{
    private $table = 'gls';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'gl_number' => '62843-00',
                'season' => 'FALL 23',
                'buyer_id' => 1,
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'gl_number' => '62900-00',
                'season' => 'SUMMER 24',
                'buyer_id' => 2,
                'category_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'gl_number' => '62950-00',
                'season' => 'WINTER 24',
                'buyer_id' => 3,
                'category_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table($this->table)->insertBatch($data);
    }
}
