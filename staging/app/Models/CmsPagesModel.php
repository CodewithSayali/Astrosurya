<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsPagesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'cms_pages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "title",
        "content",
        "seo_keywords",
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

    public function get_all_pages() {
        $results = $this
                ->select('cms_pages.*,image.page_image')
                ->join('image', 'image.page_id = cms_pages.id')
                ->where('cms_pages.is_delete', 0)
                ->orderBy('cms_pages.id', 'DESC');
        return $results->findAll();
    }

    public function get_page_details($pages) {

        $results = $this
                ->select('cms_pages.*,image.page_image')
                ->join('image', 'cms_pages.id = image.page_id ')
                ->where(['cms_pages.id' => $pages, 'image.page_id' =>$pages])
                ->orderBy('cms_pages.id', 'DESC');
//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $results->first();
    }

    function active_inactive_pages($pg_id, $data) {

        return $this->update($pg_id, $data);
    }

}
