<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UserModel;
use App\Models\RoleModel;

class AdminUser extends Controller {
    public function __construct() {
        $this->UserModel = new UserModel();
        $this->RoleModel = new RoleModel();
    }
    
    public function index() {
        $data = [];
        
        helper(['form']);
        
        $data['users'] = $this->UserModel->getAllUsers();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('/admin/users/read', $data);
        echo view('templates/footer');
    }
    
    public function create() {
        $data = [];
                
        $data['roles'] = $this->RoleModel->getAllRoles();
        
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
	        $session->setFlashdata('success', 'Successfully Added User');
                return redirect()->to('/admin-user/create');
                
            }
            
        }
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('/admin/users/create', $data);
        echo view('templates/footer');
    }
    
     public function edit ($id = 0) {
        
        $data = [];
        
        helper(['form']);
        
        $user = $this->UserModel->find($id);
        
        $data['user'] = $user;
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/users/edit', $data);
        echo view('templates/footer');
    }
    
    public function update () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'user_id' => 'required',
                'first_name' => 'required|min_length[3]|max_length[25]',
                'last_name' => 'required|min_length[3]|max_length[25]', 
                'password' => 'required|min_length[6]|max_length[60]',
                'password_confirm' => 'matches[password]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
                $newData = [
                    'user_id' => $this->request->getPost('user_id'),
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'password' => $this->request->getPost('password'),
                ];

                $this->UserModel->save($newData);
                session()->setFlashdata('message', 'Successfully Updated User');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/admin-user');

            }
        }
        
        $data['user'] = $this->UserModel->find($this->request->getPost('user_id'));
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/users/edit', $data);
        echo view('templates/footer');
    }
    
     public function delete ($id=0) {
      
        if ($this->UserModel->find($id)) {
           
            $this->UserModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted User');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/admin-user');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/admin-user');
    }
}
