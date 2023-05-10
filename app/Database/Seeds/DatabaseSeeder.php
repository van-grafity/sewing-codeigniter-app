<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('GlsTableSeeder');
        $this->call('LinesTableSeeder');
        $this->call('GroupsTableSeeder');
        $this->call('LineGroupsTableSeeder');
        $this->call('SlideshowsTableSeeder');
        $this->call('OutputRecordsTableSeeder');
    }
}
