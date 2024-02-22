<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function bid(): string
    {
        return view('header').view('bid');
    }
    public function login(): string
    {
        return view('header').view('login');
    }
    public function postProduct(): string
    {
        
        return view('header').view('createProductView');
    }
    public function about(): string
    {
        return view('header').view('about');
    }

    
}
