<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStylesTable extends Migration
{
    private $table = 'styles';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'style' => [
                'type' => 'varchar',
                'constraint' => 255, 
            ],
            'description' => [
                'type' => 'varchar',
                'constraint' => 255, 
                'null' => true
            ],
            'gl_id' => [
                'type' => 'bigint',
                'unsigned' => true, 
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
        $this->forge->addForeignKey('gl_id', 'gls', 'id');
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
