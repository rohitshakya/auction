<?php

namespace App\Services;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class DataManipulateService
{
    use ResponseTrait;

    public function __construct()
    {
    }
    public function makeEmailTemplate(string $emailTemplate,array $userData,$email,$username)
    {
        $parser = \Config\Services::parser();
        $data = [
            'Recipient Name' => $username,
            'Product Name' => $userData['name'],
            'Product Description' => $userData['description'],
            'Starting Price' => $userData['starting_price'],
            'Auction Start Date' => date("jS F, Y, h:i:s A", strtotime($userData['start_datetime'])),
            'Auction End Date' => date("jS F, Y, h:i:s A", strtotime($userData['end_datetime'])),
        ];
        return $parser->setData($data)->renderString($emailTemplate);
    }
}
