<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\PartnerCategoryModel;
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
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $data['users']=$userModel->findAll();
        $data['categories']=$categoryModel->findAll();
        return view('header').view('mapPartnerCategoryView',$data);
    }
    public function viewUsers(): string
    {

        $userModel = new UserModel();
        $page = $this->request->getGet('page') ?? 1;
        $users=array();
        $totalUsers = 0;
        if($this->sessionData && $this->sessionData['role']=='admin')
        {
            $users=$userModel->getAllUsers($page);
            $totalUsers=$userModel->countAllResults();
        }
        $data = [
            'users' => $users,
            'currentPage'=>$page,
            'totalPages'=>$totalUsers/10
        ];
        return view('header').view('userListing',$data);
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
    public function viewCategories(): string
    {

        $categoryModel = new CategoryModel();
        $page = $this->request->getGet('page') ?? 1;
        $categories=array();
        $totalCategories = 0;
        if($this->sessionData && $this->sessionData['role']=='admin')
        {
            $categories=$categoryModel->getAllCategories($page);
            $totalCategories=$categoryModel->countAllResults();
        }
        $data = [
            'categories' => $categories,
            'currentPage'=>$page,
            'totalPages'=>$totalCategories/10
        ];
        return view('header').view('categoryListing',$data);
    }
    public function mapPartnerCategory()
    {
        $postData = $this->request->getPost();
        $data = [
            'partner_id' => $postData['partner_id'],
            'category_id' => $postData['category_id'] 
        ];
        (new PartnerCategoryModel)->insert($data);
        return $this->respond(["Success"]);
    }
    public function viewMappings(): string
    {

        $PartnerCategoryModel = new PartnerCategoryModel();
        $page = $this->request->getGet('page') ?? 1;
        $mappings=array();
        $totalMappings = 0;
        if($this->sessionData && $this->sessionData['role']=='admin')
        {
            $mappings=$PartnerCategoryModel->getMappingsWithUserAndCategory();
            $totalMappings=$PartnerCategoryModel->countAllResults();
        }
        $data = [
            'mappings' => $mappings,
            'currentPage'=>$page,
            'totalPages'=>$totalMappings/10
        ];
        return view('header').view('viewMappings',$data);
    }

    
    
    

    
}
