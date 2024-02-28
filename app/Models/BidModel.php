<?php
namespace App\Models;

use CodeIgniter\Model;

class BidModel extends Model
{
    protected $table      = 'bids';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'partner_id', 'amount', 'media', 'created_at'];
    public function findBidById($bidId)
    {
        return $this->where('id', $bidId)->first();
    }
}


