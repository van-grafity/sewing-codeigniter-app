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
                'after' => 'endline_ftt',
                'null' => true,
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('remark_id', 'remarks', 'id');
        $this->forge->processIndexes($this->table);
        
        $modified_column = [
            'defact_qty' => [
                'name' => 'defect_qty',
                'type' => 'int',
                'default' => null,
                'null' => true,
            ]
        ];
        $this->forge->modifyColumn($this->table, $modified_column);
    }

    public function down()
    {
        $this->forge->dropForeignKey($this->table, 'output_records_remark_id_foreign');
        $this->forge->dropColumn($this->table, ['remark_id']);

        $modified_column = [
            'defect_qty' => [
                'name' => 'defact_qty',
                'type' => 'int',
                'default' => null,
                'null' => true,
            ]
        ];
        $this->forge->modifyColumn($this->table, $modified_column);
    }
}
