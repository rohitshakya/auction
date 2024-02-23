<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $protocol = 'smtp';
    public $SMTPHost = 'sandbox.smtp.mailtrap.io';
    public $SMTPPort = 2525;
    public $SMTPUser = 'c3f9e0d7d16a23';
    public $SMTPPass = 'f24a13c3d88202';
    public $mailType = 'html';
    public $charset = 'UTF-8';
    public $SMTPCrypto = 'tls';
    public $newline = "\r\n";
}
