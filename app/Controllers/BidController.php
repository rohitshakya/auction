<?php

namespace App\Controllers;

class BidController extends BaseController
{
    protected $bidModel;

    public function __construct()
    {
        $this->bidModel = new BidModel();
    }

    public function showByContract($id)
    {
        // Fetch all bids for a specific contract
    }

    public function create()
    {
        // Create a new bid
    }
}