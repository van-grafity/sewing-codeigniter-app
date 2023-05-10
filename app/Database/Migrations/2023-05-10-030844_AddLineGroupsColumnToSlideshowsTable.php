<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLineGroupsColumnToSlideshowsTable extends Migration
{
    private $table = 'slideshows';

    public function up()
    {
        $this->forge->dropForeignKey($this->table, 'slideshows_gl_id_foreign');
        $this->forge->dropColumn($this->table, ['gl_id']);
        $this->forge->dropForeignKey($this->table, 'slideshows_line_id_foreign');
        $this->forge->dropColumn($this->table, ['line_id']);

        $fields = [
            'line_group_id' => [
                'type' => 'bigint', 
                'unsigned' => true,
                'after' => 'id',
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('line_group_id', 'line_groups', 'id');
        $this->forge->processIndexes($this->table);
    }

    public function down()
    {
        $fields = [
            'gl_id' => [
                'type' => 'bigint', 
                'unsigned' => true, 
            ],
            'line_id' => [
                'type' => 'bigint',
                'unsigned' => true, 
            ],
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->forge->addForeignKey('gl_id', 'gls', 'id');
        $this->forge->addForeignKey('line_id', 'lines', 'id');
        $this->forge->processIndexes($this->table);

        $this->forge->dropForeignKey($this->table, 'slideshows_line_group_id_foreign');
        $this->forge->dropColumn($this->table, ['line_group_id']);
    }
}