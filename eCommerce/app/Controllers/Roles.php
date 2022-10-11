<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\RoleModel;

class Roles extends Controller {
    
    public function __construct() {
        $this->RoleModel = new RoleModel();

    }
    
    public function index () {
        $data = [];
        
        $data['roles'] = $this->RoleModel->getAllRoles();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/roles/read', $data);
        echo view('templates/footer');
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'role_name' => 'required|min_length[3]|max_length[15]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    

                    $newData = [
                        'role_name' => $this->request->getVar('role_name'),
                    ];

                    $this->RoleModel->save($newData);
                    session()->setFlashdata('success', 'Successfully Added Role');
                    return redirect()->to('/roles/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/roles/create');
        echo view('templates/footer');
    }
    
    public function edit ($id = 0) {
        
        $data = [];
        
        helper(['form']);
        
        $role = $this->RoleModel->find($id);
        
        $data['role'] = $role;
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/roles/edit', $data);
        echo view('templates/footer');
    }
    
    public function update () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'role_name' => 'required|min_length[3]|max_length[15]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
               
                $newData = [
                    'role_id' => $this->request->getPost('role_id'),
                    'role_name' => $this->request->getPost('role_name'),
                ];

                $this->RoleModel->save($newData);
                session()->setFlashdata('message', 'Successfully Updated Role');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/roles');

            }
        } 
        
    }
    
    public function delete ($id=0) {
      
        
        if ($this->RoleModel->find($id)) {
          
            $this->RoleModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted Role');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/roles');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/roles');
    }
    
}
