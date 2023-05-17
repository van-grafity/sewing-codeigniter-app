<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBuyersTable extends Migration
{
    private $table = 'buyers';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'buyer_name' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'offadd' => [
                'type' => 'varchar',
                'constraint' => 75,
                'null' => true,
            ],
            'shipadd' => [
                'type' => 'varchar',
                'constraint' => 75,
                'null' => true,
            ],
            'country' => [
                'type' => 'varchar',
                'constraint' => 35,
                'null' => true,
            ],
            'created_at'  => [
                'type' => 'datetime', 
                'null' => true
            ],
            'updated_at'  => [
                'type' => 'datetime', 
                'null' => true
            ],
            'deleted_at'  => [
                'type' => 'datetime', 
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
