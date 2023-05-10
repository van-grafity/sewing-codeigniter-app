<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLineGroupsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'group_id' => [
                'type' => 'bigint',
                'unsigned' => true, 
            ],
            'line_id' => [
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
        $this->forge->addForeignKey('line_id', 'lines', 'id');
        $this->forge->addForeignKey('group_id', 'groups', 'id');
        $this->forge->createTable('line_groups');
    }

    public function down()
    {
        $this->forge->dropTable('line_groups');
    }
}
