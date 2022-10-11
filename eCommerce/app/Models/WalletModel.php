<?php

namespace App\Models;
use CodeIgniter\Model;

class WalletModel extends Model {
    protected $table = 'tbl_wallet';
    protected $primaryKey = 'wallet_id'; 
    
    protected $allowedFields = [
        'customer_id',
        'amount_available',
        'created_at',
        'updated_at',
        'is_deleted',  
    ];
    
    function getWalletByCustomerId($user_id) {
        $query = $this->db->query('SELECT amount_available FROM tbl_wallet WHERE customer_id = '. $user_id);
        return $query->getResult();
    }
    
    function subtractOrderAmount($order_amount, $user_id) {
        $this->db->query('UPDATE tbl_wallet SET amount_available = amount_available - ' . $order_amount . ' WHERE customer_id = ' . $user_id);
    }
    
}
