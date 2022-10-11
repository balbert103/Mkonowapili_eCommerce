<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model {
    protected $table = 'tbl_roles';
    protected $primaryKey = 'role_id'; 
    
    protected $allowedFields = [
        'role_name',
        'is_deleted'    
    ];
    
    function getAllRoles() {
       $query = $this->db->query('SELECT * FROM tbl_roles');
       return $query->getResult();
    }
}
