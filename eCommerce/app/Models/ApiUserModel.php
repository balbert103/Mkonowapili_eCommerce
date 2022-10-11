<?php namespace App\Models;

use CodeIgniter\Model;

class ApiUserModel extends Model {
    protected $table = 'tbl_apiusers';
    protected $primaryKey = 'apiuser_id'; 
    
    protected $allowedFields = [
        'username',
        'key', 
        'updated_on',
        'added_by', 
        'is_deleted' 
    ];
    
    public function getAPIUser($id) {
        $query = $this->db->query('SELECT * FROM tbl_apiusers WHERE added_by = '. $id);
        return $query->getResult();
    }
}
