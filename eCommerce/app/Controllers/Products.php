<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;

class Products extends Controller {
    public function __construct() {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->SubcategoryModel = new SubcategoryModel();
    }
    
    public function index() {
        $data = [];
        
        $data['products'] = $this->ProductModel->getAllProducts();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/products/read', $data);
        echo view('templates/footer');

    }
    
    public function create() {
        $data = [];
            
        helper(['form']);
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        
        if ($this->request->getMethod() == 'post') {
            
           
            $file = $this->request->getFile('product_image');

            if ($file->isValid() && ! $file->hasMoved()) {

                $product_image = $file->getRandomName(); 
                $file->move('uploads/', $product_image); 

            }
            
            $rules = [
                'subcategory_id' => 'required',
                'product_name' => 'required|min_length[3]|max_length[25]',
                'product_description' => 'required',
                'product_price' => 'required',
                'available_quantity' => 'required',          
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;

                } else {
                    
                   
                    $newData = [
                        'subcategory_id' => $this->request->getPost('subcategory_id'),
                        'product_name' => $this->request->getPost('product_name'),
                        'product_description' => $this->request->getPost('product_description'),
                        'product_price' => $this->request->getPost('product_price'),
                        'available_quantity' => $this->request->getPost('available_quantity'),
                        'product_image' => $product_image,
                        'added_by' => session()->get('id'),
                    ];

                    $this->ProductModel->save($newData);
                    session()->setFlashdata('success', 'Successfully Added Product');
                    return redirect()->to('/products/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/products/create');
        echo view('templates/footer');
    }
    
    
    public function category() {
        $data = [];
            
        helper(['form']);
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;

            } else {
                    
                $category = $this->request->getVar('category');

                $data['subcategories'] = $this->SubcategoryModel->getSubcategories($category);


                echo view('templates/header');
                echo view('admin/templates/sidebar', $data);
                echo view('admin/templates/navigation', $data);
                echo view('admin/products/create');
                echo view('templates/footer');

                return;
            }
        
        }
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/products/create');
        echo view('templates/footer');
    }
    
    public function edit ($id = 0) {
        
        $data = [];
        
        helper(['form']);
        
        $product = $this->ProductModel->find($id);
        
        $data['product'] = $product;
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/products/edit', $data);
        echo view('templates/footer');
    }
    
    public function update () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            
           
            $file = $this->request->getFile('product_image');

            if ($file->isValid() && ! $file->hasMoved()) {

                $product_image = $file->getRandomName(); 
                $file->move('uploads/', $product_image); 

            }
            
            $rules = [
                'product_id' => 'required',
                'product_name' => 'required|min_length[3]|max_length[25]',
                'product_description' => 'required',
                'product_price' => 'required',
                'available_quantity' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
                
                $newData = [
                    'product_id' => $this->request->getPost('product_id'),
                    'product_name' => $this->request->getPost('product_name'),
                    'product_description' => $this->request->getPost('product_description'),
                    'product_price' => $this->request->getPost('product_price'),
                    'available_quantity' => $this->request->getPost('available_quantity'),
                    'product_image' => $product_image,
                    'added_by' => session()->get('id'),
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];

                $this->ProductModel->save($newData);
                session()->setFlashdata('message', 'Successfully Updated Product');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/products');

            }
        } 
        
    }
    
    public function delete ($id=0) {
      
        
        if ($this->ProductModel->find($id)) {
           
            $this->ProductModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted Product');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/products');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/products');
    }
    
}
