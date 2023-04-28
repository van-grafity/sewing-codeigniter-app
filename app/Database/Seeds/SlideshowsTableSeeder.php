<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SlideshowsTableSeeder extends Seeder
{
    private $table = 'slideshows';
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'line_id' => '1',
                'gl_id' => '1',
                'time_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'line_id' => '2',
                'gl_id' => '1',
                'time_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'line_id' => '3',
                'gl_id' => '1',
                'time_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table($this->table)->insertBatch($data);
    }
}
