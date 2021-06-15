<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/adduser', 'AdminController::add_users');
$routes->get('/admin/addbook', 'AdminController::add_book');
$routes->get('/admin/addorder', 'AdminController::add_order');
$routes->post('/admin/addorder', 'RequestController::add_order');
$routes->get('/admin/checkout', 'AdminController::checkout');
$routes->get('/admin/history', 'AdminController::history');
$routes->post('/admin/checkout', 'RequestController::add_checkout');
$routes->get('/admin/about', 'AdminController::about');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login', 'LoginController::index');
$routes->resource('/api/user', ['controller' =>'ApiUserController']);
$routes->resource('/api/buku', ['controller' =>'ApiBukuController']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}