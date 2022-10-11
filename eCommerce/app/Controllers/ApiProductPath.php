<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ApiProductPathsModel;

class ApiProductPath extends Controller {
    public function __construct() {
        $this->ApiProductPathsModel = new ApiProductPathsModel();
    }
    
    public function index () {
        $data = [];
        
        $data['api_productpaths'] = $this->ApiProductPathsModel->getAllApiProductPaths();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/read_product_path', $data);
        echo view('templates/footer');
    }
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'path' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    $newData = [
                        'path' => $this->request->getVar('path'),
                        'added_by' => session()->get('id'),
                    ];
                    
                    $this->ApiProductPathsModel->save($newData);
                    
                    session()->setFlashdata('success', 'Successfully added API product path');
                    return redirect()->to('/api-product-path/create');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('admin/api/create_product_path');
        echo view('templates/footer');
    }
    
    public function delete ($id=0) {
      
        
        if ($this->ApiProductPathsModel->find($id)) {
           
            $this->ApiProductPathsModel->delete($id);
            session()->setFlashdata('message', 'Successfully Deleted');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/api-product-path/read');
        } else {
            session()->setFlashdata('message', 'Record not fould!');
            session()->setFlashdata('alert-class', 'alert-danger');
           
        }
         return redirect()->to('/api-product-path/read');
    }
}
