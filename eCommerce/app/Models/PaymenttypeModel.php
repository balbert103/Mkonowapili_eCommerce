<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymenttypeModel extends Model {
    protected $table = 'tbl_paymenttypes';
    protected $primaryKey = 'paymenttype_id'; 
    
    protected $allowedFields = [
        'paymenttype_name',
        'description',     
    ];
    
    function getAllPaymentTypes() {
       $query = $this->db->query('SELECT * FROM tbl_paymenttypes');
       return $query->getResult();
    }

}
