<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\OrderModel;

class Users extends Controller {
    
    public function __construct() {
        $this->UserModel = new UserModel();
        $this->OrderModel = new OrderModel();

    }
    
    public function index () {
        $data = [];
        
        helper(['form']);
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'email' => 'required|min_length[6]|max_length[60]|valid_email',
                'password' => 'required|min_length[6]|max_length[60]|validateUser[email,password]',
            ];
            
            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];
            
            if (! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                
            } else {
                $user = $this->UserModel->where('email', $this->request->getVar('email'))->first();
                $this->setUserMethod($user);
                

                return redirect()->to('/dashboard');
                
            }
            
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('users/login', $data);
        echo view('templates/footer');
    }
    
    
    private function setUserMethod($user) {
        $data = [
            'id' => $user['user_id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ];
        
        session()->set($data);
        return true;
    }
    
    public function register () {
        $data = [];
        
        $model = new RoleModel();
        
        $data['roles'] = $model->getAllRoles();
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
           
            $rules = [
                'role' => 'required',
                'gender' => 'required',
                'first_name' => 'required|min_length[3]|max_length[25]',
                'last_name' => 'required|min_length[3]|max_length[25]',
                'email' => 'required|min_length[6]|max_length[60]|valid_email|is_unique[tbl_users.email]',
                'password' => 'required|min_length[6]|max_length[60]',
                'password_confirm' => 'matches[password]',
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                
            } else {
               
                $newData = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'gender' => $this->request->getVar('gender'),
                    'role' => $this->request->getVar('role'),
                ];
                
                $this->UserModel->save($newData);
                $session = session();
	        $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/login');
                
            }
            
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('users/register', $data);
        echo view('templates/footer');
    }
    
    public function profile () {
        $data = [];
        
        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'first_name' => 'required|min_length[3]|max_length[25]',
                'last_name' => 'required|min_length[3]|max_length[25]',
                'password' => 'required|min_length[6]|max_length[60]',
                'password_confirm' => 'matches[password]',
            ];
            

            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                
            } else {
               
                $newData = [
                    'user_id' => session()->get('id'),
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'password' => $this->request->getPost('password'),
                ];
                
     
                
                $this->UserModel->save($newData);
          
	        session()->setFlashdata('success', 'Updated Successfully');
                return redirect()->to('/profile');
                
            }
            
        }
        
        $data['user'] = $this->UserModel->where('user_id', session()->get('id'))->first();
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/profile');
        echo view('templates/footer');
    }
    
    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }
}
