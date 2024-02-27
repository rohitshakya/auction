<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'created_at'];
    public function getAllCategories($page = 1)
    {
        $offset = ($page - 1) * $this->perPage;
        return $this->paginate($this->perPage, '', $offset);
    }
}
