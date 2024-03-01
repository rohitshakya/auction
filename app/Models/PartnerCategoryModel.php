<?php
namespace App\Models;


use CodeIgniter\Model;
use App\Models\UserModel;
use App\Models\CategoryModel;
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
    public function getMappingsWithUserAndCategory()
    {
        return $this->select('partnerCategory.partner_id,partnerCategory.category_id, users.username, categories.name')
                    ->join('users', 'users.id = partnerCategory.partner_id')
                    ->join('categories', 'categories.id = partnerCategory.category_id')
                    ->findAll();
    }
    public function getUserByCategoryId($category_id)
    {
        return $this->db->table('partnerCategory')
                    ->select('users.email')
                    ->join('users', 'users.id = partnerCategory.partner_id')
                    ->where('partnerCategory.category_id', $category_id)
                    ->get()
                    ->getResult();
    }
}
