<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/bid', 'Home::bid');

$routes->get('/', 'ContractController::getContracts');
$routes->get('view_contract', 'ContractController::showSingleContract');

$routes->post('contracts', 'ContractController::create');
$routes->get('contracts/(:num)', 'ContractController::show/$1');
$routes->get('contracts/(:num)/bids', 'BidController::showByContract/$1');
$routes->post('bids', 'BidController::create');