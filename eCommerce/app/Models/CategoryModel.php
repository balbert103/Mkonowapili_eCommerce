<?php


namespace App\Models;

use CodeIgniter\Model;


class CategoryModel extends Model {
    protected $table = 'tbl_categories';
    protected $primaryKey = 'category_id'; 
    
    protected $allowedFields = [
        'category_name',
        'is_deleted'    
    ];
    
    
    function getAllCategories() {
       $query = $this->db->query('SELECT * FROM tbl_categories');
       return $query->getResult();
    }
}
