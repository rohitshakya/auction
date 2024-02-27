<?php
namespace App\Models;

use CodeIgniter\Model;

class PartnerCategoryModel extends Model
{
    protected $table = 'partnerCategory';
    protected $primaryKey = 'partner_id';

    protected $allowedFields = ['partner_id', 'category_id'];

    public function getCategoriesByUserId($user_id)
    {
        return $this->select('category_id')
        ->where('partner_id', $user_id)
        ->findAll();
    }
    
}
