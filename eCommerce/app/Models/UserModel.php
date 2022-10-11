<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id'; 
    
    protected $allowedFields = [
        'first_name',
        'last_name', 
        'email',
        'password', 
        'gender', 
        'role', 
        'is_deleted'    
    ];
    
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    protected function beforeInsert(array $data) {
        $data = $this->passwordHash($data);
        
        return $data;
    }
    
    protected function beforeUpdate(array $data) {
        $data = $this->passwordHash($data);
        
        return $data;
    }
    
    protected function passwordHash(array $data) {
        if(isset($data['data']['password'])) {
           $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

           return $data;   
        }
    }
    
    function getAllUsers() {
       $query = $this->db->query('SELECT * FROM tbl_users');
       return $query->getResult();
    }
    
    function getUserById($id) {
       $query = $this->db->query('SELECT * FROM tbl_users WHERE user_id = '. $id);
       return $query->getResult();
    }
    
    function getUserByEmail($email) {
       $query = $this->db->query('SELECT * FROM tbl_users WHERE email = "'. $email. '"');
       return $query->getResult();
    }
    
    function getUserByGender($gender) {
       $query = $this->db->query('SELECT * FROM tbl_users WHERE gender = "'. $gender. '"');
       return $query->getResult();
    }
    
}
