<?php

namespace App\Models;

use CodeIgniter\Model;

class seoModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'page_seo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        
        "page_id",
        "page_name",
        "title",
        "description",
        "keywords",
        "canonical_url",
        "is_active",
        "is_delete",
        "created_at",
        "updated_at",
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

    public function get_all_seo() {
        
        $results = $this
                ->select('page_seo.*')
                ->where(['is_active' => '1', 'is_delete' => 0,])
                ->orderBy('page_seo.id', 'ASC');
//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $results->find();
    }

}
