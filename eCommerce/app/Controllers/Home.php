<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Models\OrderModel;


class Home extends BaseController {
    
    public function __construct() {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->SubcategoryModel = new SubcategoryModel();
        $this->OrderModel = new OrderModel();
    }
    
    public function index() {
        $data = [];
        
        helper(['form']);
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        $data['products'] = $this->ProductModel->getAllProducts();
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('templates/sidebar_home', $data);
        echo view('pages/home', $data);
        echo view('templates/footer');
    }
    
    public function category () {
        $data = [];
            
        helper(['form']);
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
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
                
                
                if ($category == 'all') {
                    if (session()->get('id') != null) {
                        $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
                    } else {
                        $data['orders'] = []; 
                    }
                    $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
                    $data['products'] = $this->ProductModel->getAllProducts();
                
                    
                } else {
                    if (session()->get('id') != null) {
                        $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
                    } else {
                        $data['orders'] = []; 
                    }
                    $data['subcategories'] = $this->SubcategoryModel->getSubcategories($category);
                    $data['products'] = $this->ProductModel->getProductsByCategory($category);
                
                }
                
                echo view('templates/header');
                echo view('templates/navigation', $data);
                echo view('templates/sidebar_home', $data);
                echo view('pages/home', $data);
                echo view('templates/footer');

                return;
            }
        
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('templates/sidebar_home', $data);
        echo view('pages/home', $data);
        echo view('templates/footer');
    }
    
    
    public function subcategory () {
        $data = [];
            
        helper(['form']);
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'subcategory_id' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;

            } else {
                
                if (session()->get('id') != null) {
                    $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
                } else {
                    $data['orders'] = []; 
                }
                
                $subcategory = $this->request->getVar('subcategory_id');
                    
                $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
                
                $data['products'] = $this->ProductModel->getProductBySubcategory($subcategory);
                
                
                echo view('templates/header');
                echo view('templates/navigation', $data);
                echo view('templates/sidebar_home', $data);
                echo view('pages/home', $data);
                echo view('templates/footer');

                return;
            }
        
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('templates/sidebar_home', $data);
        echo view('pages/home', $data);
        echo view('templates/footer');
    }
    
    public function sort () {
        $data = [];
            
        helper(['form']);
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        $data['categories'] = $this->CategoryModel->getAllCategories();
        
        $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'sort' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;

            } else {
                    
                $sort_by = $this->request->getVar('sort');
                
               if (session()->get('id') != null) {
                    $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
                } else {
                    $data['orders'] = []; 
                }
                    
                $data['subcategories'] = $this->SubcategoryModel->getAllSubcategories();
                
                if ($sort_by == 'oldest_first') {
                    $data['products'] = $this->ProductModel->sortProductsByDateAsc();
                } elseif ($sort_by == 'newest_first') {
                    $data['products'] = $this->ProductModel->sortProductsByDateDsc();
                } elseif ($sort_by == 'lowest_price_first') {
                    $data['products'] = $this->ProductModel->sortProductsByPriceAsc();
                } elseif ($sort_by == 'highest_price_first') {
                    $data['products'] = $this->ProductModel->sortProductsByPriceDsc();
                } elseif ($sort_by == 'reset') {
                    $data['products'] = $this->ProductModel->getAllProducts();
                } else {
                    $data['products'] = $this->ProductModel->getAllProducts();
                }
                              
                
                echo view('templates/header');
                echo view('templates/navigation', $data);
                echo view('templates/sidebar_home', $data);
                echo view('pages/home', $data);
                echo view('templates/footer');

                return;
            }
        
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('templates/sidebar_home', $data);
        echo view('pages/home', $data);
        echo view('templates/footer');
    }
    
}
