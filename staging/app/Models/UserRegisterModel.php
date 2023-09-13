<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRegisterModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'user_register';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "first_name",
        "last_name",
        "email",
        "password",
        "phone",
        "dob",
        "latitude",
        "longitude",
        "timezone",
        "gender",
        "verify_code",
        "profile_flag",
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

    function check_email($email) {
        $results = $this
               ->select('user_register.*')
               ->where('email', $email)
                ->where(['is_active' => '1', 'is_delete' => 0,]);
       return $results->first();
   }
   
    function check_mobile($mobile) {
       $results = $this
               ->select('user_register.*')
               ->where('phone', $mobile)
                ->where(['is_active' => '1', 'is_delete' => 0,]);
       return $results->first();
   }

    function insert_user_data($data) {
        return $this->insert($data);
   }
   
    function check_mail_mobile($email_mobile, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('user_register');
        $query = $builder->select('*')
                ->where('password', $password)
                ->groupStart()
                ->where('email', $email_mobile)
                ->orWhere('phone', $email_mobile)
                ->groupEnd()
                ->where('is_active', '1')
                ->where('is_delete', '0')
                ->get();
//                $str=$this->getLastQuery();
//        print_r($str);
//        exit;
        return $query;
    }

    function get_user_details($user_id) {
        $results = $this
                ->select('user_register.*')
                ->where('user_register.id', $user_id);
        return $results->first();
}

    public function get_all_users() {
        $results = $this
                ->select('user_register.*')
                ->where(['is_active' => '1', 'is_delete' => 0,])
                ->orderBy('user_register.id', 'ASC');
        return $results->findAll();
    }

    public function update_user($id,$data) {
        return $this->update($id, $data);
    }

    public function delete_user($id) {
        $data = [
            'is_active' => 0,
            'is_delete' => 1,
        ];

        return $this->update($id, $data);
    }

}
