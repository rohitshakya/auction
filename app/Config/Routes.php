<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProductController::getProducts');
$routes->get('/bid', 'Home::bid');
$routes->get('/login', 'Home::login');
$routes->get('/about', 'Home::about');
$routes->get('/getProduct', 'ProductController::showSingleProduct');
$routes->get('/getBidsByProduct', 'BidController::getBidsByProduct');
$routes->get('/postProduct', 'Home::postProduct');
$routes->post('/createBid', 'BidController::createBid');
$routes->post('/products', 'ProductController::create');
$routes->post('/auth', 'AuthController::login');
