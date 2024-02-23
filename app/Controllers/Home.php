<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
class Home extends BaseController
{
    use ResponseTrait;
    public function bid(): string
    {
        return view('header').view('bid');
    }
    public function login(): string
    {
        return view('header').view('login');
    }
    public function addProduct(): string
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('header').view('createProductView',$data);
    }
    public function about(): string
    {
        return view('header').view('about');
    }
    public function createCategories(): string
    {
        return view('header').view('createCategoryView');
    }
    public function createUsers(): string
    {
        return view('header').view('createUserView');
    }


    
}
