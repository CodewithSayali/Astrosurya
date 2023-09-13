<?php

namespace App\Models;

use CodeIgniter\Model;

class ManageQueriesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'manage_queries';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "name",
        "email",
        "mobile",
        "message",
        "is_read",
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

    public function get_all_queries() {
        $results = $this
                ->select('manage_queries.*')
                ->where(['is_active' => '1', 'is_delete' => 0,])
                ->orderBy('manage_queries.id', 'ASC');
        return $results->findAll();
    }

    function active_inactive_queries($querie_id, $data) {

        return $this->update($querie_id, $data);
    }

}
