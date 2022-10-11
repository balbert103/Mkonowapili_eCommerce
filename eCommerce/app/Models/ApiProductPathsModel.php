<?php namespace App\Models;

use CodeIgniter\Model;

class ApiProductPathsModel extends Model {
    protected $table = 'tbl_apiproductpaths';
    protected $primaryKey = 'apiproductpath_id'; 
    
    protected $allowedFields = [
        'path',
        'added_by', 
        'created_at',
        'updated_at', 
        'is_deleted' 
    ];
    
    public function getAllApiProductPaths() {
        $query = $this->db->query('SELECT * FROM tbl_apiproductpaths');
        return $query->getResult();
    }
}
