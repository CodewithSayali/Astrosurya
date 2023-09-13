<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "page_id",
        "page_image",
        "seo_keywords",
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

    public function get_image() {
        $results = $this
                ->select('image.*')
                ->where(['image.page_id' => 1, 'image.page_image'])
                ->orderBy('image.page_image', 'ASC');
//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $results;
    }

}
