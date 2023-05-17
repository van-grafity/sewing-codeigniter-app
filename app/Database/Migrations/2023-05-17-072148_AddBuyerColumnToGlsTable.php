<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBuyerColumnToGlsTable extends Migration
{
    private $table = 'gls';

    public function up()
    {
        $fields = [
            'buyer_id' => [
                'type' => 'bigint', 
                'unsigned' => true,
                'after' => 'size_order',
                'null' => true,
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('buyer_id', 'buyers', 'id');
        $this->forge->processIndexes($this->table);
    }

    public function down()
    {
        $this->forge->dropForeignKey($this->table, 'gls_buyer_id_foreign');
        $this->forge->dropColumn($this->table, ['buyer_id']);
    }
}
