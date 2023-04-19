<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('GlsTableSeeder');
        $this->call('LinesTableSeeder');
        $this->call('OutputRecordsTableSeeder');
    }
}