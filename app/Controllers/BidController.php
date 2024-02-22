<?php

namespace App\Controllers;
use App\Models\BidModel;
use CodeIgniter\API\ResponseTrait;
class BidController extends BaseController
{
    use ResponseTrait;
    protected $bidModel;

    public function __construct()
    {
        $this->bidModel = new BidModel();
    }
    public function getBidsByProduct()
    {
        $productId = $this->request->getGet('productId') ?? 1;
        $bidModel = new BidModel();
        $bids = $bidModel->where('product_id', $productId)->orderBy('id', 'DESC')->findAll();
        return $this->respond($bids);
    }
    
}