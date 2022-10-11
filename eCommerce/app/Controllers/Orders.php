<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use \Mpdf\Mpdf;

use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Models\WalletModel;
use App\Models\PaymenttypeModel;

class Orders extends Controller {
    
    public function __construct() {
        $this->OrderModel = new OrderModel();
        $this->OrderDetailsModel = new OrderDetailsModel();
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->SubcategoryModel = new SubcategoryModel();
        $this->WalletModel = new WalletModel();
        $this->PaymenttypeModel = new PaymenttypeModel();
    }
    
    public function index() {
        $data = [];
        
        helper(['form']);
        
        $data['paymenttypes'] = $this->PaymenttypeModel->getAllPaymentTypes();
        $data['wallets'] = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('pages/cart', $data);
        echo view('templates/footer');
    }
    
    
    public function create() {
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
        
        if ($this->request->getMethod() == 'post') {   
            
          
            $user_pending_payment_order = $this->OrderModel->getOrderByStatusAndUserId(session()->get('id'));
            
            if ( $user_pending_payment_order ) {                 
                
                $rules = [
                'product_id' => 'required',
                'product_price' => 'required',
                'order_quantity' => 'required',    
                ];

                if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    
                    $product_id = $this->request->getPost('product_id');
                    $product_in_cart = $this->OrderDetailsModel->getProductByIdAndUserId($product_id, session()->get('id'));
                    
                    if ($product_in_cart) {
                        session()->setFlashdata('message', 'Product is already added in cart!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return redirect()->to('/');
                    }
                    
                   
                    $order_quantity = $this->request->getPost('order_quantity');           
                    $product = $this->ProductModel->where('product_id', $product_id)->first();

                    if ($order_quantity > $product['available_quantity']) {
                        session()->setFlashdata('message', 'Quantity is greater than available in stock!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return redirect()->to('/');
                    }

                    
                    $newData = [
                        'product_id' => $product_id,
                        'product_price' => $this->request->getPost('product_price'),
                        'order_quantity' => $order_quantity,
                        'customer_id' => session()->get('id'),
                    ];

                    $this->OrderDetailsModel->save($newData);
                    $this->OrderModel->updateOrderAmountByCustomerId(session()->get('id'));

                    session()->setFlashdata('message', 'Successfully added item(s) to cart');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return redirect()->to('/');

                }
            
            }
            
            $rules = [
                'product_id' => 'required',
                'product_price' => 'required',
                'order_quantity' => 'required',    
            ];
            
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;

            } else {
                
               
                $product_id = $this->request->getPost('product_id');
                $product_in_cart = $this->OrderDetailsModel->getProductByIdAndUserId($product_id, session()->get('id'));

                if ($product_in_cart) {
                    session()->setFlashdata('message', 'Product is already added in cart!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return redirect()->to('/');
                }
                
               
                $order_quantity = $this->request->getPost('order_quantity');
                $product = $this->ProductModel->where('product_id', $product_id)->first();

                if ($order_quantity > $product['available_quantity']) {
                    session()->setFlashdata('message', 'Quantity is greater than available in stock!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return redirect()->to('/');
                }
                
               
                $newData = [
                    'product_id' => $this->request->getPost('product_id'),
                    'product_price' => $this->request->getPost('product_price'),
                    'order_quantity' => $this->request->getPost('order_quantity'),
                    'customer_id' => session()->get('id'),
                ];

                $newData2 = [
                    'customer_id' => session()->get('id'),
                    'order_status' => 'pending payment',
                ];

                $this->OrderDetailsModel->save($newData);
                $this->OrderModel->save($newData2);
                $this->OrderModel->updateOrderAmountByCustomerId(session()->get('id'));

                session()->setFlashdata('message', 'Successfully added item(s) to cart');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/');

            }
        } 
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('templates/sidebar_home', $data);
        echo view('pages/home', $data);
        echo view('templates/footer');
    }
    
   
    public function add() {
        $data = [];

        helper(['form']);
        
        $data['paymenttypes'] = $this->PaymenttypeModel->getAllPaymentTypes();
        $data['wallets'] = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'orderdetails_id ' => 'required',
                'order_id ' => 'required',
                'product_id' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
                
                $orders = $this->OrderDetailsModel->getOrderDetailsById($this->request->getPost('orderdetails_id'));
            
                if ($orders) {

                    foreach ($orders as $order) {
                        $order_quantity = $order->order_quantity + 1;
                    }
                }
                
                
                $product_id = $this->request->getPost('product_id');
                $product = $this->ProductModel->where('product_id', $product_id)->first();

                if ($order_quantity > $product['available_quantity']) {
                    session()->setFlashdata('message', 'Quantity is greater than available in stock!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return redirect()->to('/orders');
                }
                
               
                $newData = [
                    'orderdetails_id' => $this->request->getPost('orderdetails_id'),
                    'order_quantity' => $order_quantity,
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];
                
                $newData2 = [
                    'order_id' => $this->request->getPost('order_id'),
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];
                

                $this->OrderDetailsModel->save($newData);
                $this->OrderModel->save($newData2);
                $this->OrderModel->updateOrderAmountByCustomerId(session()->get('id'));
                
                session()->setFlashdata('message', 'Successfully added item');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/orders');

            }
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('pages/cart', $data);
        echo view('templates/footer');
        
    }
    
   
    public function delete() {
        $data = [];

        helper(['form']);
        
        $data['paymenttypes'] = $this->PaymenttypeModel->getAllPaymentTypes();
        $data['wallets'] = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'orderdetails_id ' => 'required',
                'order_id ' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
                
                $orders = $this->OrderDetailsModel->getOrderDetailsById($this->request->getPost('orderdetails_id'));
            
                if ($orders) {

                    foreach ($orders as $order) {
                        if ($this->OrderDetailsModel->find($this->request->getPost('orderdetails_id'))) {
                            
                             $this->OrderDetailsModel->delete($this->request->getPost('orderdetails_id'));

                         } else {
                             session()->setFlashdata('message', 'Item not fould!');
                             session()->setFlashdata('alert-class', 'alert-danger');
                             return redirect()->to('/orders');
                         }      
                    }
                }
                
                $newData2 = [
                    'order_id' => $this->request->getPost('order_id'),
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];
                
                $this->OrderModel->save($newData2);
                $this->OrderModel->updateOrderAmountByCustomerId(session()->get('id'));
                
                session()->setFlashdata('message', 'Completely removed item from cart');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/orders');

            }
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('pages/cart', $data);
        echo view('templates/footer');
    }
    
    
    
    public function remove() {
        $data = [];

        helper(['form']);
        
        $data['paymenttypes'] = $this->PaymenttypeModel->getAllPaymentTypes();
        $data['wallets'] = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'orderdetails_id ' => 'required',
                'order_id ' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

            } else {
                
                $orders = $this->OrderDetailsModel->getOrderDetailsById($this->request->getPost('orderdetails_id'));
            
                if ($orders) {

                    foreach ($orders as $order) {
                        
                        if ($order->order_quantity > 1) {
                            $order_quantity = $order->order_quantity - 1;
                        } else {
                            if ($this->OrderDetailsModel->find($this->request->getPost('orderdetails_id'))) {
                                
                                 $this->OrderDetailsModel->delete($this->request->getPost('orderdetails_id'));
                                 session()->setFlashdata('message', 'Completely removed item from cart');
                                 session()->setFlashdata('alert-class', 'alert-success');
                                 return redirect()->to('/orders');
                             } else {
                                 session()->setFlashdata('message', 'Item not fould!');
                                 session()->setFlashdata('alert-class', 'alert-danger');

                             }
                              return redirect()->to('/orders');
                        }
                    }
                }
                
                
                $newData = [
                    'orderdetails_id' => $this->request->getPost('orderdetails_id'),
                    'order_quantity' => $order_quantity,
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];
                
                $newData2 = [
                    'order_id' => $this->request->getPost('order_id'),
                    'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                ];
                

                $this->OrderDetailsModel->save($newData);
                $this->OrderModel->save($newData2);
                $this->OrderModel->updateOrderAmountByCustomerId(session()->get('id'));
                
                session()->setFlashdata('message', 'Successfully removed item');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->to('/orders');

            }
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('pages/cart', $data);
        echo view('templates/footer');
        
    }
    
    
    public function order() {
        $data = [];
        
        helper(['form']);
        
        $data['paymenttypes'] = $this->PaymenttypeModel->getAllPaymentTypes();
        $data['wallets'] = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
        
        if (session()->get('id') != null) {
            $data['orders'] = $this->OrderModel->getAllOrdersByUserId(session()->get('id'));
        } else {
            $data['orders'] = []; 
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'order_id' => 'required',
                'payment_type' => 'required',
            ];
            
            if (! $this->validate($rules)) {
                    $data['validation'] = $this->validator;

                } else {
                    
                    
                    $orders = $this->OrderModel->getOrderByCustomerId(session()->get('id'));
                    $wallets = $this->WalletModel->getWalletByCustomerId(session()->get('id'));
                    
                    if (! $wallets) {
                        session()->setFlashdata('message', 'You neet to create a wallet first in order to purchase items');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return redirect()->to('/orders');
                    }
                    
                    foreach ($orders as $order) {
                        foreach ($wallets as $wallet) {
                            if ($order->order_amount > $wallet->amount_available) {
                                session()->setFlashdata('message', 'You don\'t have enough money to order these items!');
                                session()->setFlashdata('alert-class', 'alert-danger');
                                return redirect()->to('/orders');
                            }
                        }
                    }
                    
                   
                    $newData = [
                        'order_id' => $this->request->getPost('order_id'),
                        'order_status' => 'paid',
                        'payment_type' => $this->request->getPost('payment_type'),
                        'updated_at' => new Time('now', 'Africa/Nairobi', 'en_US'),
                    ];
                               
                    
                    $this->OrderModel->save($newData);
                    
                   
                    foreach ($orders as $order) {
                        $this->WalletModel->subtractOrderAmount($order->order_amount, session()->get('id'));  
                    }
                    
                   
                    $mpdf = new Mpdf();
                    
                    $mpdf->SetWatermarkText('RECEIPT');
                    $mpdf->showWatermarkText = true;
                    
                    $mpdf->SetHeader('Receipt');
                    $mpdf->SetFooter('Thank You!');
                    
                   
                    $not_deleted_orders = $this->OrderDetailsModel->getOrdersWhereIsDeletedIsFalse(session()->get('id'));
                    
                    foreach ($not_deleted_orders as $not_deleted_order) {
                        $mpdf->WriteHTML('<p>Product Name: ' . $not_deleted_order->product_name . '</p>');
                        $mpdf->WriteHTML('<p>Product Quantity: ' . $not_deleted_order->order_quantity . '</p>');
                        $mpdf->WriteHTML('<p>Product Price: ' . $not_deleted_order->product_price . '</p>');
                        $mpdf->WriteHTML('<br/>'); 
                    }
                    
                    
                    $mpdf->WriteHTML('<br/>');
                    
                    foreach ($orders as $order) {
                        $mpdf->WriteHTML('<p> Total Price: ' . $order->order_amount. '</p>');
                        $mpdf->WriteHTML('<p> Amount Paid: ' . $order->order_amount. '</p>');
                    }
                    
                    
                    $wallet = $this->WalletModel->where('customer_id', session()->get('id'))->first(); 
                    $mpdf->WriteHTML('<p> Wallet Balance: ' . $wallet['amount_available'] . '</p>');
                    
                   
                    $this->OrderDetailsModel->deleteAllOrdersWhereIsDeletedIsFalse(session()->get('id'));
                    
                    session()->setFlashdata('message', 'Successfully purchased item(s). We will contact you shortly');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return redirect()->to($mpdf->Output('receipt.pdf', 'I'));

                }
        }
        
        echo view('templates/header');
        echo view('templates/navigation', $data);
        echo view('pages/cart', $data);
        echo view('templates/footer');
    }
    
   
    public function history() {
        $data = [];

        $id = session()->get('id');

        $data['orders'] = $this->OrderDetailsModel->getOrdersWhereIsDeletedIsTrue(session()->get('id'));

        echo view('templates/header');
        echo view('admin/templates/sidebar', $data);
        echo view('admin/templates/navigation', $data);
        echo view('users/order_history', $data);
        echo view('templates/footer');
    }
    
}
