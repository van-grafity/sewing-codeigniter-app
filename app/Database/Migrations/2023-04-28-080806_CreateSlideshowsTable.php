<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSlideshowsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'gl_id' => [
                'type' => 'bigint', 
                'unsigned' => true, 
            ],
            'line_id' => [
                'type' => 'bigint',
                'unsigned' => true, 
            ],
            'time_date' => [
                'type' => 'date',
                'null' => true,
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
        $this->forge->addForeignKey('line_id', 'lines', 'id');
        $this->forge->createTable('slideshows');
    }

    public function down()
    {
        $this->forge->dropTable('slideshows');
    }
}
