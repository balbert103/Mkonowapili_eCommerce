<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ApiTokensModel;
use App\Models\ApiProductsModel;
use App\Models\ApiUserModel;

class ApiTokens extends Controller {
    public function __construct() {
        $this->ApiTokensModel = new ApiTokensModel();
        $this->ApiProductsModel = new ApiProductsModel();
        $this->ApiUserModel = new ApiUserModel();
    }
    
    
    public function index () {
        $data = [];
        
        $data['api_tokens'] = $this->ApiTokensModel->getAllApiTokens(session()->get('id'));
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/read_api_tokens', $data);
        echo view('templates/footer');
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        $data['api_products'] = $this->ApiProductsModel->getAllApiProducts();
        $data['api_users'] = $this->ApiUserModel->getAPIUser(session()->get('id'));
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'api_userid' => 'required',
                'api_productid' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    $tokens = $this->ApiUserModel->getAPIUser(session()->get('id'));
                    
                    foreach ($tokens as $token) {
                        $token = $token->key;
                    }
                                        
                   
                    $newData = [
                        'api_userid' => $this->request->getVar('api_userid'),
                        'api_productid' => $this->request->getVar('api_productid'),
                        'api_token' => $token,
                        'expires_on' => null,
                    ];
                   
                    $this->ApiTokensModel->save($newData);
                    
                    session()->setFlashdata('success', 'Successfully subscribed to API product');
                    return redirect()->to('/api-token/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/subscribe_to_api_product');
        echo view('templates/footer');
    }
    
    public function delete ($id=0) {
      
        
        if ($this->ApiTokensModel->find($id)) {
         
            $this->ApiTokensModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/api-token/read');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/api-token/read');
    }
}
