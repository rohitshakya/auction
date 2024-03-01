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
       
        $perPage = $this->perPage;
        $offset = ($page - 1) * $perPage;

        $query = $this->select('products.*, categories.name as category_name')
                    ->join('categories', 'categories.id = products.category_id', 'left')
                    ->orderBy('products.id', 'asc')
                    ->paginate($perPage, '', $offset);

        return $query;
    }
    public function getProductById($productId)
    {
        return $this->select('products.*, categories.name as category_name')
        ->join('categories', 'categories.id = products.category_id', 'left')
        ->where('products.id', $productId)
        ->get()
        ->getRow();
    }
    public function getAllProductsByCategories($categories, $page = 1)
    {
        $offset = ($page - 1) * $this->perPage;
        return $this->whereIn('category_id', $categories)
                    ->paginate($this->perPage, '', $offset);
    }
}
