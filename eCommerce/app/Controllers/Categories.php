<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\CategoryModel;

class Categories extends Controller {
    
    public function __construct() {
        $this->CategoryModel = new CategoryModel();
    }
    
    public function index () {
        $data = [];
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/categories/read', $data);
        echo view('templates/footer');
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category_name' => 'required|min_length[3]|max_length[25]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                   
                    $newData = [
                        'category_name' => $this->request->getVar('category_name'),
                    ];

                    $this->CategoryModel->save($newData);
                    session()->setFlashdata('success', 'Successfully Added Category');
                    return redirect()->to('/categories/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/categories/create');
        echo view('templates/footer');
    }
    
    public function edit ($id = 0) {

       $data = [];

       helper(['form']);

       $category = $this->CategoryModel->find($id);

       $data['category'] = $category;

       echo view('templates/header');
       echo view('admin/templates/sidebar', $data);
       echo view('admin/templates/navigation', $data);
       echo view('admin/categories/edit', $data);
       echo view('templates/footer');
   }
   
    public function update () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category_name' => 'required|min_length[3]|max_length[25]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
               
                $newData = [
                    'category_id' => $this->request->getPost('category_id'),
                    'category_name' => $this->request->getPost('category_name'),
                ];

                $this->CategoryModel->save($newData);
                session()->setFlashdata('message', 'Successfully Updated Category');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/categories');

            }
        } 
        
    }
    
    public function delete ($id=0) {
      
        
        if ($this->CategoryModel->find($id)) {
           
            $this->CategoryModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted Category');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/categories');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/categories');
    }
    
}
