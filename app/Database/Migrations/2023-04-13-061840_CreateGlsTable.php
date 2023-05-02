<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGlsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'gl_number' => [
                'type' => 'varchar', 
                'constraint' => 20
            ],
            // 'buyer_id' => [
            //     'type' => 'bigint',
            //     'unsigned' => true, 
            // ],
            'season' => [
                'type' => 'varchar', 
                'constraint' => 20
            ],
            'size_order' => [
                'type' => 'varchar', 
                'constraint' => 20,
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
        // $this->forge->addForeignKey('buyer_id', 'buyers', 'id');
        $this->forge->createTable('gls');
    }

    public function down()
    {
        $this->forge->dropTable('gls');
    }
}
