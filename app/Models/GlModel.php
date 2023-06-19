<?php

namespace App\Models;

use CodeIgniter\Model;

class GlModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gls';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['gl_number','season','buyer_id','category_id'];

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

        $builder = $this->db->table('gls');
        $builder->select('*');
        $builder->where('deleted_at',null);
        $builder->orderBy('gl_number','asc');
        $gls = $builder->get()->getResult();

        foreach ($gls as $key => $data) {
            $data->buyer = $this->hasOne('buyers', $data->buyer_id);
            $data->category = $this->hasOne('categories', $data->category_id);
        }

        return $gls;
    }

    function hasOne($table_relation_with, $foreign_key){

        $builder = $this->db->table($table_relation_with);
        $builder->select('*');
        $builder->where('id', $foreign_key);
        $query = $builder->get();
        return $query->getFirstRow();
    }
}
