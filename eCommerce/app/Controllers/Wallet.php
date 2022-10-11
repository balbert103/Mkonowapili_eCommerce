<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WalletModel;
use CodeIgniter\I18n\Time;


class Wallet extends Controller{
    
    public function __construct() {
        $this->WalletModel = new WalletModel();
    }
    
    public function index() {
        $data = [];
        
        $id = session()->get('id');
        
        $data['wallet'] = $this->WalletModel->where('customer_id', $id)->first();
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/wallet/wallet', $data);
        echo view('templates/footer');
    }
    
    
    public function create () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'amount' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    $newData = [
                        'customer_id' => session()->get('id'),
                        'amount_available' => $this->request->getVar('amount'),
                        'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                    ];

                    $this->WalletModel->save($newData);
                    session()->setFlashdata('success', 'Successfully created your wallet');
                    return redirect()->to('/wallet');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/wallet/create', $data);
        echo view('templates/footer');
    }
    
    
    public function recharge () {
        $data = [];

        helper(['form']);
        
        if ($this->request->getMethod() == 'post') {
            
            $id = session()->get('id');
        
            $user_wallet = $this->WalletModel->where('customer_id', $id)->first();
            
            $rules = [
                'amount' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                  
                    $newData = [
                        'wallet_id' => $user_wallet['wallet_id'],
                        'amount_available' => $this->request->getVar('amount') + $user_wallet['amount_available'],
                        'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                    ];

                    $this->WalletModel->save($newData);
                    session()->setFlashdata('success', 'Successfully recharged your wallet');
                    return redirect()->to('/wallet');

                }
        } 
        
        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/wallet/recharge', $data);
        echo view('templates/footer');
    }
   
}
