<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateModel extends Model
{
    protected $table      = 'EmailTemplates';
    protected $primaryKey = 'template_id'; 

    protected $allowedFields = ['template_name', 'subject', 'html_content', 'created_at', 'modified_at'];
    public function findTemplateById($templateId)
    {
        return $this->find($templateId);
    }
}