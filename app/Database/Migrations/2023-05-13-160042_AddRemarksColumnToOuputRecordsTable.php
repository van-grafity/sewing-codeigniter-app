<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRemarksColumnToOuputRecordsTable extends Migration
{
    private $table = 'output_records';

    public function up()
    {
        $fields = [
            'remark_id' => [
                'type' => 'bigint', 
                'unsigned' => true,
                'after' => 'id',
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('remark_id', 'remarks', 'id');
        $this->forge->processIndexes($this->table);
    }

    public function down()
    {
        $this->forge->dropForeignKey($this->table, 'output_records_remark_id_foreign');
        $this->forge->dropColumn($this->table, ['remark_id']);
    }
}
