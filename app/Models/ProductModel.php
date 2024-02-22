<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'description', 'category_id', 'user_id', 'starting_price', 'start_datetime', 'end_datetime', 'media', 'created_at'];

    protected $perPage = 10;

    public function getAllProducts($page = 1)
    {
        $offset = ($page - 1) * $this->perPage;
        return $this->paginate($this->perPage, '', $offset);
    }
    public function getProductById($productId)
    {
        return $this->find($productId);
    }
}
