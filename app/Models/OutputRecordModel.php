<?php

namespace App\Models;

use CodeIgniter\Model;

class OutputRecordModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'output_records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['gl_id', 'line_id', 'time_date', 'time_hours_of', 'target', 'output', 'defect_qty', 'endline_ftt', 'downtime_min', 'remark_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getData()
    {
        $builder = $this->db->table('output_records');
        $builder->select('*');
        $builder->where('deleted_at', null);
        $builder->orderBy('time_date', 'desc');
        $builder->orderBy('line_id');
        $builder->orderBy('time_hours_of');
        $output_records = $builder->get()->getResult();

        foreach ($output_records as $key => $data) {

            $data->gls = $this->hasOne('gls', $data->gl_id);
            $data->lines = $this->hasOne('lines', $data->line_id);
        }
        return $output_records;
    }

    public function get_gl_list($params = null)
    {
        $line_id = isset($params->line_id) ? $params->line_id : null;
        $time_date = isset($params->time_date) ? $params->time_date : null;

        $builder = $this->db->table('output_records');
        $builder->join('gls', 'gls.id = output_records.gl_id');
        $builder->join('categories', 'categories.id = gls.category_id', 'left');
        $builder->select('gls.gl_number, categories.category_name');
        $builder->when($line_id, static function ($query, $line_id) {
            $query->where('output_records.line_id', $line_id);
        });
        $builder->when($time_date, static function ($query, $time_date) {
            $query->where('output_records.time_date', $time_date);
        });
        $builder->groupBy('gl_id');
        $gl_list = $builder->get()->getResult();

        return $gl_list;
    }

    function hasOne($table_relation_with, $foreign_key)
    {
        $builder = $this->db->table($table_relation_with);
        $builder->select('*');
        $builder->where('id', $foreign_key);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getDatatable()
    {
        $builder = $this->db->table('output_records');
        $builder->select('output_records.id, time_date, lines.name as line, time_hours_of, gls.gl_number, target, output, defect_qty');
        $builder->join('lines', 'lines.id = output_records.line_id');
        $builder->join('gls', 'gls.id = output_records.gl_id');
        $builder->where('output_records.deleted_at', null);
        return $builder;
    }
}
