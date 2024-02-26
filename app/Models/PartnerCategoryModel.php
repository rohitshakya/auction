<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerCategoryModel extends Model
{
    protected $table = 'partner_category';

    public function getCategoriesByUserId($user_id)
    {
        return $this->select('categories.*')
                    ->join('partners', 'partners.id = partner_category.partner_id')
                    ->join('categories', 'categories.id = partner_category.category_id')
                    ->where('partners.user_id', $user_id)
                    ->findAll();
    }
}
