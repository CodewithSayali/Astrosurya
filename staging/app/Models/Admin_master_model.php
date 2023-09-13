<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_master_model extends Model {

    protected $DBGroup = 'default';
    protected $table = 'admin_master';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    //protected $insertID             = 0;
    protected $returnType = 'array';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "email",
        "password",
        "pin",
        "is_active",
        "is_delete"
    ];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    function check_admin_login($data) {
        $results = $this
                ->select('admin_master.*')
                ->where(['email' => $data['email'], 'password' => $data['password'], 'pin' => $data['pin']]);
        
         return $results->first();
    }
    
    function active_inactive_bonds($id,$update_data){
        $db = \Config\Database::connect();
        $builder = $db->table('bond_details');
        $query = $builder->update($update_data, ['id' => $id]);
        return $query;
    }
    
//    function delete_bonds($id,$update_data){
//        $db = \Config\Database::connect();
//        $builder = $db->table('bond_details');
//        $query = $builder->update($update_data, ['id' => $id]);
//        return $query;
//    }
    

//
}
