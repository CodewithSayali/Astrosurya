<?php

namespace App\Models;

use CodeIgniter\Model;

class MailAttachmentModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'mail_attachment';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "mail_id",
        "attachment",
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

    
    public function get_attachments() {
        $results = $this
                ->select('mail_attachment.*')
                ->where(['mail_attachment.mail_id' => 3, 'mail_attachment.attachment'])
                ->orderBy('image.attachment', 'ASC');
//        $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $results;
    }

}
