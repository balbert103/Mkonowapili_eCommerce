<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller {
    
    public function index () {
        $data = [];
        
        echo view('templates/header');
       
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/dashboard', $data);
        echo view('templates/footer');
    }
    
}
