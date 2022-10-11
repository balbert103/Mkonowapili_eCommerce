<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id'; 
    
    protected $allowedFields = [
        'product_name',
        'product_description',
        'product_image',
        'product_price',
        'available_quantity',
        'subcategory_id',
        'updated_at',
        'added_by',
        'is_deleted'    
    ];
    
    function getProductById($id) {
        $query = $this->db->query('SELECT * FROM tbl_product WHERE product_id = ' . $id);
        return $query->getResult();
    }
    
    function getAllProducts() {
       $query = $this->db->query('SELECT * FROM tbl_product');
       return $query->getResult();
    }
    
    function getProductsByCategory($category) {
       $query = $this->db->query('SELECT * FROM tbl_product AS p INNER JOIN tbl_subcategories AS s ON p.subcategory_id = s.subcategory_id INNER JOIN tbl_categories AS c ON s.category = c.category_id WHERE c.category_id = ' . $category);
       return $query->getResult();
    }
    
    function getProductBySubcategory($subcategory) {
        $query = $this->db->query('SELECT * FROM tbl_product WHERE subcategory_id = '. $subcategory);
       return $query->getResult();
    }
    
    function sortProductsByDateAsc() {
       $query = $this->db->query('SELECT * FROM tbl_product ORDER BY created_at ASC');
       return $query->getResult();
    }
    
    function sortProductsByDateDsc() {
       $query = $this->db->query('SELECT * FROM tbl_product ORDER BY created_at DESC');
       return $query->getResult();
    }
    
    function sortProductsByPriceAsc() {
       $query = $this->db->query('SELECT * FROM tbl_product ORDER BY product_price ASC');
       return $query->getResult();
    }
    
    function sortProductsByPriceDsc() {
       $query = $this->db->query('SELECT * FROM tbl_product ORDER BY product_price DESC');
       return $query->getResult();
    }
    
}
