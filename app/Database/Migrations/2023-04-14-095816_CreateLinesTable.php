<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLinesTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'name'  => ['type' => 'varchar', 'constraint' => 31],
            'description'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('name');
        $this->forge->addKey(['deleted_at', 'id']);
        $this->forge->addKey('created_at');

        $this->forge->createTable('lines');
    }

    public function down()
    {
        $this->forge->dropTable('lines');
    }
}
