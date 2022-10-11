<?php namespace App\Models;


use CodeIgniter\Model;

class ApiTokensModel extends Model {
    protected $table = 'tbl_apitokens';
    protected $primaryKey = 'apitoken_id'; 
    
    protected $allowedFields = [
        'api_userid',
        'api_productid', 
        'api_token',
        'created_at', 
        'expires_on',
        'is_deleted'
    ];
    
    public function getAllApiTokens($id) {
        $query = $this->db->query('SELECT * FROM tbl_apitokens AS at INNER JOIN tbl_apiproducts AS ap ON at.api_productid = ap.apiproduct_id INNER JOIN tbl_apiusers AS au ON at.api_userid = au.apiuser_id WHERE au.added_by = '. $id);
        return $query->getResult();
    }
    
    public function getAllApiTokensByUsername($username) {
        $query = $this->db->query('SELECT * FROM tbl_apitokens AS at INNER JOIN tbl_apiproducts AS ap ON at.api_productid = ap.apiproduct_id INNER JOIN tbl_apiusers AS au ON at.api_userid = au.apiuser_id WHERE au.username = "'. $username . '"');
        return $query->getResult();
    }
}
