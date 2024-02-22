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
        $contractId = $this->request->getGet('productId') ?? 1;
        $bidModel = new BidModel();
        $bids = $bidModel->where('product_id', $contractId)->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON($bids);
    }
    public function createBid()
    {
        $postData =  $this->request->getPost();
        $validationRules = [
            'user_id' => 'required|integer',
            'contract_id' => 'required|integer',
            'amount' => 'required|numeric'
        ];
       
        if (!$this->validate($validationRules, $postData)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $bidData = [
            'user_id' => $postData['user_id'],
            'contract_id' => $postData['product_id'],
            'amount' => $postData['amount']
        ];
        $this->bidModel->insert($bidData);
        return $this->respondCreated(['message' => 'Bid created successfully']);
    }
    
}