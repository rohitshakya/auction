<?php

namespace App\Controllers;

use App\Models\ContractModel;

class ContractController extends BaseController
{
    protected $contractModel;

    public function __construct()
    {
        $this->contractModel = new ContractModel();
    }

    public function getContracts()
    {
        $page = $this->request->getGet('page') ?? 1;
        $contracts=$this->contractModel->getAllContracts($page);
        $data = [
            'contracts' => $contracts,
            'currentPage'=>$page,
            'totalPages'=>10 //logic to be write
        ];
        return view('header').view('bid',$data);
    }

    public function showSingleContract()
    {
        $id = $this->request->getGet('id') ?? 1;
        $contract=$this->contractModel->getContractById($id);
        $data = [
            'contract' => $contract,
        ];
        return view('header').view('itemView',$data);
    }

    public function create()
    {
        // Create a new contract
    }
}



