<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home');
$routes->get('/paymentAPI/(:any)/(:any)', 'PaymentAPI::index/$1/$2');
$routes->get('/ticketAPI/(:any)/(:any)', 'TicketAPI::index/$1/$2');
$routes->get('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login_action', 'LoginController::login_action');
$routes->post('/choose-seats/(:segment)', 'Home::showSeats/$1');
$routes->get('/detail/(:segment)', 'Home::detail/$1');
$routes->post('/payment', 'PaymentController::choosePaymentMethod');
$routes->get('/purchases', 'PurchasesController::showPurchases');
$routes->get('/purchase/(:segment)', 'PurchasesController::detail/$1');
$routes->get('/ticket/create', 'TicketController::create');
$routes->post('/purchase', 'PaymentController::purchase');
