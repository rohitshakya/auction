<?php


namespace App\Models;

use CodeIgniter\Model;

class ContractModel extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'description', 'budget', 'status'];

    protected $perPage = 10;

    public function getAllContracts($page = 1)
    {
        $offset = ($page - 1) * $this->perPage;
        return $this->paginate($this->perPage, '', $offset);
    }
    public function getContractById($contractId)
    {
        return $this->find($contractId);
    }
}


