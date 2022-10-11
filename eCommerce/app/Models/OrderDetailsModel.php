<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailsModel extends Model {
    protected $table = 'tbl_orderdetails';
    protected $primaryKey = 'orderdetails_id'; 
    
    protected $allowedFields = [
        'customer_id',
        'product_id',
        'product_price',
        'order_quantity',
        'updated_at',
        'is_deleted',       
    ];
    
    function getOrderDetailsById ($orderDetailsId) {
        $query = $this->db->query('SELECT * FROM tbl_orderdetails WHERE orderdetails_id = '. $orderDetailsId);
        return $query->getResult();
    }
    
    function deleteAllOrdersWhereIsDeletedIsFalse($user_id) {
        $this->db->query('UPDATE tbl_orderdetails SET updated_at = CURRENT_TIMESTAMP, is_deleted = TRUE WHERE is_deleted = FALSE AND customer_id = ' . $user_id);
    }
    
    function getOrdersWhereIsDeletedIsFalse($user_id) {
        $query = $this->db->query('SELECT * FROM tbl_orderdetails AS od INNER JOIN tbl_product AS p ON od.product_id = p.product_id WHERE od.is_deleted = FALSE AND od.customer_id = ' . $user_id);
        return $query->getResult();
    }
    
    function getOrdersWhereIsDeletedIsTrue($user_id) {
       $query = $this->db->query('SELECT * FROM tbl_orderdetails AS od INNER JOIN tbl_product AS p ON od.product_id = p.product_id INNER JOIN tbl_order AS o ON od.customer_id = o.customer_id WHERE od.is_deleted = TRUE AND od.customer_id = ' . $user_id);
       return $query->getResult();
    }
    
    function getProductByIdAndUserId($product_id, $user_id) {
       $query = $this->db->query('SELECT * FROM tbl_order AS o INNER JOIN tbl_orderdetails AS od ON o.customer_id = od.customer_id INNER JOIN tbl_product AS p ON od.product_id = p.product_id WHERE o.order_status = "pending payment" AND od.is_deleted = FALSE AND od.product_id = '.$product_id .' AND o.customer_id = ' . $user_id);
       return $query->getResult();
    }
    
}
