<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ApiTokensModel;
use App\Models\ApiProductsModel;
use App\Models\ApiUserModel;

class ApiProducts extends Controller {
    public function __construct() {
        $this->ApiTokensModel = new ApiTokensModel();
        $this->ApiProductsModel = new ApiProductsModel();
        $this->ApiUserModel = new ApiUserModel();
    }
    
    
    public function index () {
        $data = [];
        
        $data['api_products'] = $this->ApiProductsModel->getAllApiProducts();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/read_product', $data);
        echo view('templates/footer');;
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'productname' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    $newData = [
                        'productname' => $this->request->getVar('productname'),
                        'added_by' => session()->get('id'),
                    ];
                    
                    $this->ApiProductsModel->save($newData);
                    
                    session()->setFlashdata('success', 'Successfully added API product');
                    return redirect()->to('/api-product/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/create_product');
        echo view('templates/footer');
    }
    
    public function delete ($id=0) {
      
        if ($this->ApiProductsModel->find($id)) {
            $this->ApiProductsModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/api-product/read');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/api-product/read');
    }
}
