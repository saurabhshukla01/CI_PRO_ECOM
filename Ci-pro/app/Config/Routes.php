<?php

use App\Controllers\CartController;
use App\Controllers\ProductController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/add-products', 'ProductController::addProduct');
$routes->get('/products', 'ProductController::index');
$routes->post('product/submitForm', 'ProductController::submitForm');
$routes->get('cart/add/(:num)', 'ProductController::addToCart/$1');
$routes->get('cart/remove/(:num)', 'ProductController::removeFromCart/$1');
$routes->get('cart', 'CartController::index');
$routes->post('cart/addToCart', 'CartController::addToCart');