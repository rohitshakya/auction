<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $protocol = 'smtp';
    public $SMTPHost = 'smtp.example.com';
    public $SMTPPort = 587;
    public $SMTPUser = 'your@example.com';
    public $SMTPPass = 'your_password';
    public $mailType = 'html';
    public $charset = 'UTF-8';
    public $SMTPCrypto = 'tls';
    public $newline = "\r\n";
}
