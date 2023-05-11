<?php

namespace App\Models;

use CodeIgniter\Model;

class LineGroupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'line_groups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id','line_id'];

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

        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('deleted_at',null);
        $lineGroups = $builder->get()->getResult();

        return $lineGroups;
    }

    public function getLinesByGroupId($group_id = null) {
        if(!$group_id) { return array(); }

        $builder = $this->db->table($this->table);
        $builder->select('lines.*');
        $builder->join('lines', 'lines.id = line_id');
        $builder->where('group_id', $group_id);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
}
