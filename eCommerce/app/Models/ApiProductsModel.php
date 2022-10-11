<?php namespace App\Models;


use CodeIgniter\Model;

class ApiProductsModel extends Model {
    protected $table = 'tbl_apiproducts';
    protected $primaryKey = 'apiproduct_id'; 
    
    protected $allowedFields = [
        'productname',
        'added_by', 
        'created_at',
        'updated_on', 
        'is_deleted' 
    ];
    
    public function getAllApiProducts() {
        $query = $this->db->query('SELECT * FROM tbl_apiproducts');
        return $query->getResult();
    }
}
