<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthApiUserAndAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       
       if(! (session()->get('isLoggedIn') && session()->get('role') == 3 || session()->get('role') == 1)){
          return redirect()->to('/');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}