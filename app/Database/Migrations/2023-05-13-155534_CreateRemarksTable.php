<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRemarksTable extends Migration
{
    private $table = 'remarks';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'remark' => [
                'type' => 'varchar',
                'constraint' => 255, 
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
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
