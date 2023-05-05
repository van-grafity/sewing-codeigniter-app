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
    protected $allowedFields    = ['gl_id','line_id','time_date','time_hours_of','target','output','defact_qty','endline_ftt','downtime_min'];

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


    public function getData() {

        $builder = $this->db->table('output_records');
        $builder->select('*');
        $builder->where('deleted_at',null);
        $builder->orderBy('time_date');
        $builder->orderBy('line_id');
        $builder->orderBy('time_hours_of');
        $output_records = $builder->get()->getResult();

        foreach ($output_records as $key => $data) {

            $data->gls = $this->hasOne('gls', $data->gl_id);
            $data->lines = $this->hasOne('lines', $data->line_id);
        }
        return $output_records;
    }

    function hasOne($table_relation_with, $foreign_key){

        $builder = $this->db->table($table_relation_with);
        $builder->select('*');
        $builder->where('id', $foreign_key);
        $query = $builder->get();
        return $query->getRow();
    }
}
