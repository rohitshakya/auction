<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $perPage = 10;

    protected $allowedFields = [
        'name', 'description', 'category_id', 'user_id', 'starting_price', 
        'start_datetime', 'end_datetime', 'media', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

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
