<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // Handle login form submission
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password')??'';

        // Validate credentials (you should hash and verify the password)
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Generate token
            $token = bin2hex(random_bytes(32));

            // Save token to the database
            $this->userModel->update($user['id'], ['token' => $token]);

            // Save token in session
            session()->set('token', $token);

            // Redirect to dashboard or wherever you want
            return redirect()->to('/dashboard');
        }

        // Handle invalid credentials
        // Redirect to login page with error message
        return redirect()->to('/login')->with('error', 'Invalid email or password');
    }

    public function signup()
    {
        // Handle signup form submission
        // Similar to login, but create a new user record and generate/save token
    }
}
