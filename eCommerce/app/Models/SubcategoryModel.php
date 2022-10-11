<?php


namespace App\Models;

use CodeIgniter\Model;


class SubcategoryModel extends Model {
    protected $table = 'tbl_subcategories';
    protected $primaryKey = 'subcategory_id'; 
    
    protected $allowedFields = [
        'category',
        'subcategory_name',
        'is_deleted'    
    ];
   
    function getAllSubcategories() {
       $query = $this->db->query('SELECT * FROM tbl_subcategories');
       return $query->getResult();
    }
    
    function getSubcategories($category) {
       $query = $this->db->query('SELECT * FROM tbl_subcategories WHERE category = '. $category);
       return $query->getResult();
    }
}
