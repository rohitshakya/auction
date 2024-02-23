<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
       
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password')??'';
        $user = $this->userModel->where('email', $email)->first();
        
        if ($user) {
            if ($password===$user['password']) {
                $token = bin2hex(random_bytes(32));
                $this->userModel->update($user['id'], ['token' => $token]);
                
                session()->set('token', $token);
                session()->set('role',$user['role']);
                
                $data['token'] = $token;
                $data['role'] = $user['role'];
                $data['msg'] = "Success";
                return $this->respond($data);
            }
        }
        $data['error']="Invalid email or password";
        return $this->respond($data);
    }

    public function logout()
    {
        session()->remove('token'); 
        session()->destroy(); 
        return redirect()->to(base_url('login'));

    }
    public function signup()
    {
        // Handle signup form submission
        // Similar to login, but create a new user record and generate/save token
    }
}
