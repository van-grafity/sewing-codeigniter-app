<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class SlideshowModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'slideshows';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id','time_date','flag_active'];

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
        
        $builder = $this->db->table('slideshows');
        $builder->select('*');
        $builder->where('deleted_at',null);
        $builder->orderBy('group_id','asc');
        $output_records = $builder->get()->getResult();

        foreach ($output_records as $key => $data) {

            $data->groups = $this->hasOne('groups', $data->group_id);
            // $data->time_date = Time::createFromFormat('Y-m-d', $data->time_date, 'Asia/Jakarta')->toLocalizedString('d MMMM yyyy');

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
