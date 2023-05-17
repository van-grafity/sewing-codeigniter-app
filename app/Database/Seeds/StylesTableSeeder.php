<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StylesTableSeeder extends Seeder
{
    private $table = 'styles';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'style' => '4169AU23',
                'description' => 'Short Sleeve Polos',
                'gl_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                
            ],
            [
                'id' => 2,
                'style' => '4163AU23',
                'description' => 'Short Sleeve Stripes',
                'gl_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'style' => '6000AU23',
                'description' => 'Short Sleeve Motif',
                'gl_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'style' => '6500AU23',
                'description' => 'Short Sleeve Polos',
                'gl_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'style' => '7000AU23',
                'description' => 'Long Sleeve Polos',
                'gl_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
