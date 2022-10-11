<?php namespace App\Controllers;

use App\Models\ApiUserModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ApiTokensModel;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Api extends ResourceController {
    
    private function getKey() {
        return "my_application_secret";
    }
    
    public function all_users() {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        $authHeader = $this->request->getHeader('username');
        $authHeader = $authHeader->getValue();
        $username = (string) $authHeader;
        
        $model = new ApiTokensModel();
        $users = $model->getAllApiTokensByUsername($username);
        
        //check if user exists
        if (! $users) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
        
        //check if user has subscribed to userdetails
        foreach ($users as $user) {
            if (! ($user->productname == 'userdetails')) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'messages' => 'You haven\'t subscribed to userdetails',
                    'data' => [],
                ];

                return $this->respondCreated($response);
            }
        }
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new UserModel();
                $users = $model->findAll();
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'All Users',
                    'data' => [
                        'users' => $users
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    
    public function u_show($id = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        $authHeader = $this->request->getHeader('username');
        $authHeader = $authHeader->getValue();
        $username = (string) $authHeader;
        
        $model = new ApiTokensModel();
        $users = $model->getAllApiTokensByUsername($username);
        
        //check if user exists
        if (! $users) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
        
        //check if user i subscibed
        foreach ($users as $user) {
            if (! ($user->productname == 'userdetails')) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'messages' => 'You haven\'t subscribed to userdetails',
                    'data' => [],
                ];

                return $this->respondCreated($response);
            }
        }
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new UserModel();
                $user = $model->getUserById($id);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User',
                    'data' => [
                        'user' => $user
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    
    public function u_show_e($email = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        $authHeader = $this->request->getHeader('username');
        $authHeader = $authHeader->getValue();
        $username = (string) $authHeader;
        
        $model = new ApiTokensModel();
        $users = $model->getAllApiTokensByUsername($username);
        
        //check if user exists
        if (! $users) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
        
        //check if user i subscibed
        foreach ($users as $user) {
            if (! ($user->productname == 'userdetails')) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'messages' => 'You haven\'t subscribed to userdetails',
                    'data' => [],
                ];

                return $this->respondCreated($response);
            }
        }
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new UserModel();
                $user = $model->getUserByEmail($email);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User',
                    'data' => [
                        'user' => $user
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    public function u_show_g($gender = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        $authHeader = $this->request->getHeader('username');
        $authHeader = $authHeader->getValue();
        $username = (string) $authHeader;
        
        $model = new ApiTokensModel();
        $users = $model->getAllApiTokensByUsername($username);
        
        //check if user exists
        if (! $users) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
        
        //check if user i subscibed
        foreach ($users as $user) {
            if (! ($user->productname == 'userdetails')) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'messages' => 'You haven\'t subscribed to userdetails',
                    'data' => [],
                ];

                return $this->respondCreated($response);
            }
        }
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new UserModel();
                $user = $model->getUserByGender($gender);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User',
                    'data' => [
                        'user' => $user
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
     
    public function index() {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new ProductModel();
                $products = $model->findAll();
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User details',
                    'data' => [
                        'products' => $products
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
                
    }
    
    public function p_category($category = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new ProductModel();
                $product = $model->getProductsByCategory($category);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User details',
                    'data' => [
                        'product' => $product
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    
    public function p_subcategory($subcategory = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new ProductModel();
                $product = $model->getProductBySubcategory($subcategory);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User details',
                    'data' => [
                        'product' => $product
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    
    public function show($id = null) {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            
            if ($decoded) {
                $model = new ProductModel();
                $product = $model->getProductById($id);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User details',
                    'data' => [
                        'product' => $product
                    ],
                ];
                
                return $this->respondCreated($response);
            } 
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => [],
            ];

            return $this->respondCreated($response);
        }
    }
    
    public function register () {
        helper(['form']);
        
        $data = [];
        
        if($this->request->getMethod() != 'post') {
            return $this->fail('Only post request is allowed');
        }
        
        $rules = [
            'username' => 'required|min_length[3]|max_length[10]|is_unique[tbl_apiusers.username]',
        ];
        
        if (!$this->validate($rules)) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {
            $apiserModel = new ApiUserModel();
            
            $key = $this->getKey();
            
            $iat = time(); //current timestamp value
            $nbf = $iat + 10;
            
            $payload = array(
                'iss' => 'The_claim',
                'aud' => 'The_Aud',
                'iat' => $iat, // issued at
                'nbf' => $nbf //not before in seconds
            );
            
            $token = JWT::encode($payload, $key);

            $data = [
                'username' => $this->request->getVar('username'),
                'key' => $token
            ];
            
            if ($apiserModel->insert($data)) {
                $response = [
                    'status' => 200,
                    "error" => false,
                    'messages' => 'Successfully, user has been registered',
                    'data' => [
                        'token' => $token
                    ]
                ];
            } else {

                $response = [
                    'status' => 500,
                    "error" => true,
                    'messages' => 'Failed to create user',
                    'data' => []
                ];
            }
        }
        
        return $this->respondCreated($response);
    }
}

