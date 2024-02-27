<?php

namespace App\Controllers;
use App\Models\BidModel;
use CodeIgniter\API\ResponseTrait;
class BidController extends BaseController
{
    use ResponseTrait;
    protected $bidModel;
    protected $sessionData;

    public function __construct()
    {
        if(!$this->checkSession()){
            return redirect()->to(base_url('login'))->send();
        }
        $this->sessionData = session()->get();
    }
    public function getBidsByProduct()
    {
        $getData = $this->request->getGet();
        $productId=$getData['id'];
        $bidModel = new BidModel();
        if(session('role')=='partner')
        {
            $bids = $bidModel->where('product_id', $productId)
            ->where('partner_id', session('user_id'))
            ->orderBy('id', 'DESC')->findAll();
        }else
        {   
            $bids = $bidModel->where('product_id', $productId)
            ->orderBy('id', 'DESC')->findAll();
        }
        return $this->respond($bids);
    }
    public function createBid()
    {
        $postData = $this->request->getPost();
        $pdfFile = $this->request->getFile('pdf_file');
        $fileData = file_get_contents($pdfFile->getTempName());
        
        $base64Data = base64_encode($fileData);
        $data = [
            'product_id' => $postData['productId'] ?? null,
            'partner_id' => $postData['partnerId'] ?? null,
            'amount'     => $postData['bidAmount'],
            'media'      => $base64Data ?? null, 
        ];
        
        (new BidModel)->insert($data);
        //$this->sendEmailNotification();
        return $this->respond(["status"=>true,"msg"=>"Success"]);
    }
    
    
}