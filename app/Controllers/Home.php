<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
class Home extends BaseController
{
    use ResponseTrait;
    protected $sessionData;
    public function __construct()
    {
        if(!$this->checkSession()){
            return redirect()->to(base_url('login'))->send();
        }
        $this->sessionData = session()->get();
    }
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
    public function mapPartner(): string
    {
        return view('header').view('mapPartnerCategoryView');
    }
    public function viewUsers(): string
    {
        return view('header').view('mapPartnerCategoryView');
    }
    public function viewProducts(): string
    {

        $productModel = new ProductModel();
        $page = $this->request->getGet('page') ?? 1;
        $products=array();
        $totalProducts = 0;
        if($this->sessionData && $this->sessionData['role']=='admin')
        {
            $products=$productModel->getAllProducts($page);
            $totalProducts=$productModel->countAllResults();
        }
        $data = [
            'products' => $products,
            'currentPage'=>$page,
            'totalPages'=>$totalProducts/10
        ];
        return view('header').view('productListing',$data);
    }
    

    
}
