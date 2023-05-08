<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '100',
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
		$this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
