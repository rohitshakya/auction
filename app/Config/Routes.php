<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ContractController::getContracts');
$routes->get('/bid', 'Home::bid');
$routes->get('getContract', 'ContractController::showSingleContract');
$routes->get('/getBidsByContract', 'BidController::getBidsByContract');

$routes->post('/createBid', 'BidController::createBid');
$routes->post('contracts', 'ContractController::create');