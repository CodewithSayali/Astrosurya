<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        
        "name",
        "icon",
        "description",
        "price",
        "gst",
        "service_charge",
        "tax",
        "is_active",
        "is_delete",
        "created_at",
        "updated_at"
    ];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
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

    public function get_all_services() {
        $results = $this
                ->select('services.*')
                ->where(['is_delete' => 0,])
                ->orderBy('services.id', 'ASC');
        return $results->findAll();
    }
    
        public function get_all_active_services() {
        $results = $this
                ->select('services.*')
                ->where(['is_active' => 1,])
                ->where(['is_delete' => 0,])
                ->orderBy('services.id', 'ASC');
        return $results->findAll();
    }
    
    public function get_active_services_by_id($service_id)
    {
        $results = $this
                ->select('services.*')
                ->where(['id' => $service_id,])
                ->where(['is_active' => 1,])
                ->where(['is_delete' => 0,])
                ->orderBy('services.id', 'ASC');
        return $results->findAll();
    }
    
    public function update_service($service_id, $data) {
        return $this->update($service_id, $data);
//         $str=$this->getLastQuery();
//        print_r($str);
//        exit;
    }
    
     public function delete_service($id) {
        $data = [
            'is_active' => 0,
            'is_delete' => 1,
        ];
//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $this->update($id, $data);
    }
    
     function active_inactive_services($service_id, $data) {

        return $this->update($service_id, $data);
    }

}
