<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'manage_settings';
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

    public function get_all_settings() {
        $results = $this
                ->select('manage_settings.*')
//                ->where(['is_active' => '1', 'is_delete' => 0,])
                ->orderBy('manage_settings.id', 'ASC');
        return $results->findAll();
    }

    function get_setting_logo($id) {
        $query = $this->table('manage_settings')->asArray()->getWhere(['id' => $id]);
        return $query->getNumRows();
    }

    function update_setting_logo($id, $update_data) {
        $db = \Config\Database::connect();
        $builder = $db->table('manage_settings');
        $query = $builder->update($update_data, ['id' => $id]);
        return $query;
    }
    
     public function update_setting($settingId,$data) {
        return $this->update($settingId, $data);
    }

}
