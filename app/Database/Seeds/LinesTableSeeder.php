<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LinesTableSeeder extends Seeder
{
    private $table = 'lines';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'A1',
                'description' => 'Meja nomor 1 pada Factory A',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'A2',
                'description' => 'Meja nomor 2 pada Factory A',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'A3',
                'description' => 'Meja nomor 3 pada Factory A',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table($this->table)->insertBatch($data);
    }
}
