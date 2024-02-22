<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $ProductModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
    }

    public function getProducts()
    {
        $page = $this->request->getGet('page') ?? 1;
        $products=$this->ProductModel->getAllProducts($page);
        $data = [
            'products' => $products,
            'currentPage'=>$page,
            'totalPages'=>10 //logic to be write
        ];
        return view('header').view('bid',$data);
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

    public function create()
    {
        // Create a new product
    }
}



