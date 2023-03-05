<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages', 'Berkas');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// //Home
// $routes->get('/', 'Home::index');
// $routes->get('/Home/jaringanIrigasi', 'Home::jaringanIrigasi');
// $routes->get('/Home/daerahIrigasi', 'Home::daerahIrigasi');
// $routes->get('/Home/dokumentasi', 'Home::dokumentasi');
// $routes->get('/Home/data', 'Home::dataIrigasi');
// $routes->get('/Home/login', 'Home::login');


//Pages
$routes->get('/', 'Pages::index');
$routes->get('/Pages/jaringanIrigasi', 'Pages::jaringanIrigasi');
$routes->get('/Pages/daerahIrigasi', 'Pages::daerahIrigasi');
$routes->get('/Pages/bangunanIrigasi', 'Pages::bangunanIrigasi');
$routes->get('/Pages/dokumentasi', 'Pages::dokumentasi');
$routes->get('/Pages/dataIrigasi', 'Berkas::dataIrigasi');
$routes->get('/Pages/login', 'Pages::login');

//Admin =DataController = Berkas
$routes->get('Berkas', 'Berkas::index');
$routes->get('Berkas/save', 'Berkas::index');
$routes->get('Berkas/create', 'Berkas::create');
$routes->get('Berkas/download/(:num)', 'Berkas::download/$1');
$routes->get('Berkas/update/(:num)', 'Berkas::update/$1');
$routes->post('Berkas/save', 'Berkas::save');
$routes->post('Berkas/updateData/(:num)', 'Berkas::updateData/$1');
$routes->delete('Berkas/delete/(:num)', 'Berkas::delete/$1');

//Login
$routes->get('Login', 'Login::index');
$routes->post('Login/process', 'Login::process');
$routes->get('Login/logout', 'Login::logout');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
