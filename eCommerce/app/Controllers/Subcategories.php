<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\SubcategoryModel;
use App\Models\CategoryModel;

class Subcategories extends Controller {
    public  function __construct() {
        $this->SubcategoryModel = new SubcategoryModel();
    }
    
    public function index () {
        $data = [];
        
        helper(['form']);
        
        $model = new CategoryModel();
       
       

        $data['categories'] = $model->getAllCategories();
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    $category = $this->request->getVar('category');
                    
                    if ($category == 'all') {
                        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
                    } else {
                        $data['subcategories'] = $this->SubcategoryModel->getSubcategories($category);
                    }
                    
                    
                    echo view('templates/header');
                    echo view('admin/templates/sidebar', $data);
                    echo view('admin/templates/navigation', $data);
                    echo view('admin/categories/subcategories/read', $data);
                    echo view('templates/footer');
                    
                    return;
                }
            
        }
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/categories/subcategories/read', $data);
        echo view('templates/footer');
    }
    
    public function create () {
       $data = [];

       helper(['form']);
       
       $model = new CategoryModel();
       
      
       $data['categories'] = $model->getAllCategories();

       if ($this->request->getMethod() == 'post') {
           $rules = [
               'category' => 'required',
               'subcategory_name' => 'required|min_length[3]|max_length[25]',
           ];

           if (! $this->validate($rules)) {
                   $data['validation'] = $this->validator;

               } else {
                   
                   $newData = [
                       'category' => $this->request->getVar('category'),
                       'subcategory_name' => $this->request->getVar('subcategory_name'),
                   ];

                   $this->SubcategoryModel->save($newData);
                   session()->setFlashdata('success', 'Successfully Added Subcategory');
                   return redirect()->to('/subcategories/create');

               }
       } 

        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/categories/subcategories/create', $data);
        echo view('templates/footer');
    }
    
    public function edit ($id = 0) {
        
        $data = [];
        
        helper(['form']);
        
        $model = new CategoryModel();
       
      
        $data['categories'] = $model->getAllCategories();
        
        $subcategory = $this->SubcategoryModel->find($id);
        
        $data['subcategory'] = $subcategory;
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/categories/subcategories/edit', $data);
        echo view('templates/footer');
    }
    
    public function update () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'subcategory_id' => 'required',
                'category' => 'required',
                'subcategory_name' => 'required|min_length[3]|max_length[25]',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
               
                $newData = [
                    'subcategory_id' => $this->request->getPost('subcategory_id'),
                    'category' => $this->request->getPost('category'),
                    'subcategory_name' => $this->request->getPost('subcategory_name'),
                ];

                $this->SubcategoryModel->save($newData);
                session()->setFlashdata('message', 'Successfully Updated Subcategory');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/subcategories');

            }
        } 
        
    }
    
    public function delete ($id=0) {
      
        
        if ($this->SubcategoryModel->find($id)) {
           
            $this->SubcategoryModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted Subcategory');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/subcategories');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/subcategories');
    }

    
    
}
