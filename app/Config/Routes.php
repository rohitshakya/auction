<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'ProductController::getProducts');
$routes->get('/bid', 'Home::bid');
$routes->get('/login', 'Home::login');
$routes->get('/about', 'Home::about');
$routes->get('/viewPdf', 'Home::viewPdf');
$routes->get('/createCategories', 'Home::createCategories');
$routes->get('/createUsers', 'Home::createUsers');
$routes->get('/addProduct', 'Home::addProduct');


$routes->get('/getProduct', 'ProductController::getProduct');
$routes->get('/getBidsByProduct', 'BidController::getBidsByProduct');
$routes->post('/createProduct', 'ProductController::createProduct');
$routes->post('/addCategory', 'ProductController::addCategory');
$routes->post('/addUser', 'ProductController::addUser');


$routes->post('/auth', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');


$routes->get('/testEmail', 'NotificationController::sendEmailNotification');