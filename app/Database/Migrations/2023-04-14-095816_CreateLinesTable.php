<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLinesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'varchar', 
                'constraint' => 20
            ],
            'description' => [
                'type' => 'varchar', 
                'constraint' => 255, 
                'null' => true
            ],
            'created_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
            'updated_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('lines');
    }

    public function down()
    {
        $this->forge->dropTable('lines');
    }
}
