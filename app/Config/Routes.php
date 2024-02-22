<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/bid', 'Home::bid');
$routes->get('/login', 'Home::login');
$routes->get('/about', 'Home::about');
$routes->get('/addProduct', 'Home::postProduct');

$routes->get('/', 'ProductController::getProducts');
$routes->get('/getProduct', 'ProductController::getProduct');
$routes->get('/getBidsByProduct', 'BidController::getBidsByProduct');
$routes->post('/createProduct', 'ProductController::createProduct');

$routes->post('/auth', 'AuthController::login');
