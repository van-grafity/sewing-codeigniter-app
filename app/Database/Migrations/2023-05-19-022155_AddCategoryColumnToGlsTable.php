<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryColumnToGlsTable extends Migration
{
    private $table = 'gls';

    public function up()
    {
        $fields = [
            'category_id' => [
                'type' => 'bigint', 
                'unsigned' => true,
                'after' => 'buyer_id',
                'null' => true,
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->processIndexes($this->table);
    }

    public function down()
    {
        $this->forge->dropForeignKey($this->table, 'gls_category_id_foreign');
        $this->forge->dropColumn($this->table, ['category_id']);
    }
}
