<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ApiUserModel;
use Firebase\JWT\JWT;

class ApiUser extends Controller {
    public function __construct() {
        $this->ApiUserModel = new ApiUserModel();
    }
    
    private function getKey() {
        return "my_application_secret";
    }
    
    public function index () {
        $data = [];
        
        $data['api_users'] = $this->ApiUserModel->getAPIUser(session()->get('id'));
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/read_api_users', $data);
        echo view('templates/footer');
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[10]|is_unique[tbl_apiusers.username]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    $key = $this->getKey();
            
                    $iat = time(); 
                    $nbf = $iat + 10;
                    $exp = $iat + 3600;

                    $payload = array(
                        'iss' => 'The_claim',
                        'aud' => 'The_Aud',
                        'iat' => $iat, 
                        'nbf' => $nbf, 
                        'exp' => $exp, 
                    );

                    $token = JWT::encode($payload, $key);
                    
                    
                    $newData = [
                        'username' => $this->request->getVar('username'),
                        'key' => $token,
                        'added_by' => session()->get('id')
                    ];

                    $this->ApiUserModel->save($newData);
                    session()->setFlashdata('success', 'Successfully added API user');
                    return redirect()->to('/api-user/read');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/create_api_user', $data);
        echo view('templates/footer');
    }
    
    public function delete ($id=0) {
      
        
        if ($this->ApiUserModel->find($id)) {
           
            $this->ApiUserModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/api-user/read');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/api-user/read');
    }
}
