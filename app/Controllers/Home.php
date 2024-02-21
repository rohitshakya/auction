<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function bid(): string
    {
        return view('bid');
    }
    public function login(): string
    {
        return view('login');
    }
    public function postContract(): string
    {
        return view('createContractView');
    }

    
}
