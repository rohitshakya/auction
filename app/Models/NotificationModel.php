<?php namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'type',
        'message',
        'is_read',
        'related_id',
        'created_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
