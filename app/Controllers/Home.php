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
}
