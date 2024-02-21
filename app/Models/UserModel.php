<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'bids';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'contract_id', 'amount'];
    
}


