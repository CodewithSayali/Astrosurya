<?php

namespace App\Models;

use CodeIgniter\Model;

class ManageTeamModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'manage_teams';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "fullname",
        "designation",
        "image",
        "content",
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

    public function get_all_teams() {
        $results = $this
                ->select('manage_teams.*')
                ->where(['is_delete' => 0,])
                ->orderBy('manage_teams.id', 'ASC');
        return $results->findAll();
    }

    public function update_team($team_id, $data) {
        return $this->update($team_id, $data);
//         $str=$this->getLastQuery();
//        print_r($str);
//        exit;
    }
     public function get_teams_details() {

        $results = $this
                ->select('manage_teams.*')
                ->where(['manage_teams.is_active' => 1])
                ->where(['manage_teams.is_delete' => 0])
                ->limit(3,0)
                ->orderBy('manage_teams.id', 'DESC');

//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $results->findAll();
    }
    
     function active_inactive_teams($team_id, $data) {

        return $this->update($team_id, $data);
    }

}
