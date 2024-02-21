<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ContractController::getContracts');
$routes->get('/bid', 'Home::bid');
$routes->get('/login', 'Home::login');
$routes->get('getContract', 'ContractController::showSingleContract');
$routes->get('/getBidsByContract', 'BidController::getBidsByContract');
$routes->get('/postContract', 'Home::postContract');
$routes->post('/createBid', 'BidController::createBid');
$routes->post('contracts', 'ContractController::create');