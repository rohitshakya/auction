<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
class ProductController extends BaseController
{
    use ResponseTrait;
    protected $ProductModel;

    public function __construct()
    {

        $this->checkSession();
        $this->ProductModel = new ProductModel();
    }

    public function getProducts()
    {
        
        $page = $this->request->getGet('page') ?? 1;
        $products=$this->ProductModel->getAllProducts($page);
        $totalProducts=$this->ProductModel->countAllResults();
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
        $this->checkSession();
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
        return $this->respond(["Success"]);
    }
}



