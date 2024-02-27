<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PartnerCategoryModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
class ProductController extends BaseController
{
    use ResponseTrait;
    protected $ProductModel;
    protected $sessionData;

    public function __construct()
    {
        if(!$this->checkSession()){
            return redirect()->to(base_url('login'))->send();
        }
        $this->sessionData = session()->get();
        $this->ProductModel = new ProductModel();
        
    }
    public function getProducts()
    {
        $page = $this->request->getGet('page') ?? 1;
        $products=array();
        $totalProducts = 0;
        if($this->sessionData && $this->sessionData['role']=='admin')
        {
            $products=$this->ProductModel->getAllProducts($page);
            $totalProducts=$this->ProductModel->countAllResults();
        }
        else if($this->sessionData && $this->sessionData['role']=='partner')
        {
            $cat_id = (new PartnerCategoryModel)->getCategoriesByUserId($this->sessionData['user_id']);
            $catIds = [];
            foreach ($cat_id as $result) {
                $catIds[] = $result['category_id'];
            }
            
            $products=$this->ProductModel->getAllProductsByCategories($catIds,$page);
            $totalProducts=$this->ProductModel->countAllResults();
        }
        $data = [
            'products' => $products,
            'currentPage'=>$page,
            'totalPages'=>$totalProducts/10
        ];
        return view('header').view('home',$data);
    }

    public function getProduct()
    {
        $id = $this->request->getGet('id') ?? 1;
        $product=$this->ProductModel->getProductById($id);
        $data = [
            'product' => $product,
        ];
        return view('header').view('itemView',$data);
    }
    public function createProduct()
    {
        $postData = $this->request->getPost();
        $pdfFile = $this->request->getFile('pdf_file');
        $fileData = file_get_contents($pdfFile->getTempName());
        
        $base64Data = base64_encode($fileData);
        $data = [
            'name' => $postData['name'] ?? '',
            'description' => $postData['description'] ?? null,
            'category_id' => $postData['categoryId'] ?? null,
            'user_id' => $postData['user_id'] ?? 1,
            'starting_price' => $postData['starting_price'] ?? 0,
            'start_datetime' => $postData['start_datetime'] ?? '',
            'end_datetime' => $postData['end_datetime'] ?? '',
            'media' => $base64Data ?? null, 
            'status' => $postData['status'] ?? 'active'
        ];
        $this->ProductModel->insert($data);
        $emailController = new NotificationController();
        
        $emailController->sendEmailNotification();
        return $this->respond(["Success"]);
    }
    public function addCategory()
    {
        $postData = $this->request->getPost();
        $data = [
            'name' => $postData['categoryTitle']
        ];
        (new CategoryModel())->insert($data);
        return $this->respond(["status"=>true,"msg"=>"Category Added!!"]);
    }
    public function addUser()
    {
        $postData = $this->request->getPost();
        $data = [
            'username' => $postData['username'] ?? '',
            'email' => $postData['email'] ?? '',
            'password' => password_hash($postData['password'] ?? 'HelloWorld123#', PASSWORD_DEFAULT),
            'role' => $postData['role'] ?? 'buyer'
        ];
        
        (new UserModel())->insert($data);
        return $this->respond(["status"=>true,"msg"=>"User Added!!"]);
    }
}



