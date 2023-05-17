<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BuyersTableSeeder extends Seeder
{
    private $table = 'buyers';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'buyer_name' => 'AEROPOSTALE',
                'offadd' => 'Office Address 1',
                'shipadd' => 'Shipping Address 1',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'buyer_name' => 'AMAZON',
                'offadd' => 'Office Address 2',
                'shipadd' => 'SAV1 - Garden City, GA',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'buyer_name' => 'CHICOS FAS INC',
                'offadd' => 'Office Address 3',
                'shipadd' => 'Shipping Address 3',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'buyer_name' => 'FOOT LOCKER',
                'offadd' => 'Office Address 4',
                'shipadd' => 'Shipping Address 4',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'buyer_name' => 'GIII APPAREL',
                'offadd' => 'Office Address 5',
                'shipadd' => 'Shipping Address 5',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'buyer_name' => 'KOHLS',
                'offadd' => 'Office Address 6',
                'shipadd' => 'Shipping Address 6',
                'country' => 'USA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'buyer_name' => 'LORD & TAYLOR',
                'offadd' => 'Office Address 7',
                'shipadd' => 'Shipping Address 7',
                'country' => 'Country 7',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'buyer_name' => 'MACY INC',
                'offadd' => 'Office Address 8',
                'shipadd' => 'Shipping Address 8',
                'country' => 'Country 8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'buyer_name' => 'NAUTICA',
                'offadd' => 'Office Address 9',
                'shipadd' => 'Shipping Address 9',
                'country' => 'Country 9',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'buyer_name' => 'PVH',
                'offadd' => 'Office Address 10',
                'shipadd' => 'Shipping Address 10',
                'country' => 'Country 8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'buyer_name' => 'ROSS STORE',
                'offadd' => 'Office Address 11',
                'shipadd' => 'Shipping Address 11',
                'country' => 'Country 8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 12,
                'buyer_name' => 'WALMART',
                'offadd' => 'Office Address 12',
                'shipadd' => 'Shipping Address 12',
                'country' => 'Country 8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
