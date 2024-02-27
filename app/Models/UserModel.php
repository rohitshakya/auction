<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'token', 'role', 'created_at'];
    protected $useTimestamps = false;
    public function getAllUsers($page = 1)
    {
        $offset = ($page - 1) * $this->perPage;
        return $this->paginate($this->perPage, '', $offset);
    }
}
