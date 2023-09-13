<?php

namespace App\Models;

use CodeIgniter\Model;

class MailTemplatesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'mail_templates';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "subject",
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

    public function get_all_mails() {
        $results = $this
                ->select('mail_templates.*,mail_attachment.attachment')
                ->join('mail_attachment', 'mail_attachment.mail_id = mail_templates.id')
                ->where('mail_templates.is_delete', 0)
                ->orderBy('mail_templates.id', 'DESC');
        
        return $results->findAll();
    }
    
     function active_inactive_mails($mail_id, $data) {

        return $this->update($mail_id, $data);
    }

}
