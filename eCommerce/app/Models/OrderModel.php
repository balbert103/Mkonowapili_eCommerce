<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id'; 
    
    protected $allowedFields = [
        'customer_id',
        'order_amount',
        'order_status',
        'payment_type',
        'orderdetails_id',
        'updated_at',
        'is_deleted',       
    ];
    
    function getOrderByCustomerId($user_id) {
        $query = $this->db->query('SELECT order_amount from tbl_order WHERE order_status = "pending payment" AND customer_id = '. $user_id);
        return $query->getResult();
    }
    
    function getAllOrdersByUserId($user_id) {
       $query = $this->db->query('SELECT * FROM tbl_order AS o INNER JOIN tbl_orderdetails AS od ON o.customer_id = od.customer_id INNER JOIN tbl_product AS p ON od.product_id = p.product_id WHERE o.order_status = "pending payment" AND od.is_deleted = FALSE AND o.customer_id = ' . $user_id);
       return $query->getResult();
    }
    
    function getOrderByStatusAndUserId($user_id) {
        $query = $this->db->query('SELECT * FROM tbl_order WHERE order_status = "pending payment" AND customer_id = ' . $user_id);
        return $query->getResult();
    }
    
    function updateOrderAmountByCustomerId($user_id) {
        $this->db->query('UPDATE tbl_order SET order_amount = (SELECT SUM(orderdetails_total) FROM tbl_orderdetails AS od INNER JOIN tbl_order AS o ON od.customer_id = o.customer_id WHERE o.order_status = "pending payment" AND od.is_deleted = FALSE AND o.customer_id = ' . $user_id . ') WHERE customer_id = ' . $user_id);
    }
}
