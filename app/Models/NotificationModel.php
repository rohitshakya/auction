<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'recipient_email',
        'subject',
        'message',
        'status',
        'created_at',
        'retry_count',
        'error_message'
    ];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = null; // Since there's no updated_at field in the schema
    protected $deletedField = null; // Since there's no deleted_at field in the schema

    protected $validationRules = []; // You can define validation rules if needed
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function addNotification($data)
    {
        return $this->insert($data);
    }
}
