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

//Pages
$routes->get('/', 'Pages::index');
$routes->get('Pages/berita/(:any)', 'Pages::berita/$1');
// $routes->get('/Pages/jaringanIrigasi', 'Pages::jaringanIrigasi');
// $routes->get('/Pages/daerahIrigasi', 'Pages::daerahIrigasi');
// $routes->get('/Pages/bangunanIrigasi', 'Pages::bangunanIrigasi');
// $routes->get('/Pages/pelaporan', 'Pages::pelaporan');
// $routes->get('/Pages/dataIrigasi', 'Pages::dataIrigasi');
// $routes->get('/Pages/detail/(:num)', 'Pages::detail/$1');
// $routes->get('/Pages/login', 'Pages::login');

//Berkas
$routes->get('Berkas', 'Berkas::index');
$routes->get('Berkas/save', 'Berkas::index');
$routes->get('Berkas/create', 'Berkas::create');
$routes->get('Berkas/download/(:num)', 'Berkas::download/$1');
$routes->get('Berkas/update/(:num)', 'Berkas::update/$1');
$routes->post('Berkas/save', 'Berkas::save');
$routes->post('Berkas/updateData/(:num)', 'Berkas::updateData/$1');
$routes->delete('Berkas/delete/(:num)', 'Berkas::delete/$1');

//admin
$routes->get('Admin', 'Admin::index');

//admin->laporan
$routes->post('Admin/saveLaporan', 'Admin::saveLaporan');
$routes->get('Admin/terimaLaporan/(:num)', 'Admin::terimaLaporan/$1');
$routes->delete('Admin/tolakLaporan/(:num)', 'Admin::tolakLaporan/$1');
//admin->berita
$routes->post('Admin/tambahBerita', 'Admin::tambahBerita');
$routes->post('Admin/update/(:num)', 'Admin::update/$1');
$routes->post('Admin/updateBerita/(:num)', 'Admin::updateBerita/$1');
$routes->delete('Admin/delete/(:num)', 'Admin::delete/$1');

//PETA
//Jaringan Irigasi
$routes->post('Irigasi/simpanJaringanIrigasi', 'Irigasi::simpanJaringanIrigasi');
$routes->get('Irigasi/ubahJaringanIrigasi/(:num)', 'Irigasi::ubahJaringanIrigasi/$1');
$routes->get('Irigasi/simpanUbahJaringanIrigasi/(:num)', 'Irigasi::simpanUbahJaringanIrigasi/$1');
$routes->delete('Irigasi/hapusJaringanIrigasi/(:num)', 'Irigasi::hapusJaringanIrigasi/$1');
//Daerah Irigasi
$routes->post('Irigasi/simpanDaerahIrigasi', 'Irigasi::simpanDaerahIrigasi');
$routes->get('Irigasi/ubahDaerahIrigasi/(:num)', 'Irigasi::ubahDaerahIrigasi/$1');
$routes->get('Irigasi/simpanUbahDaerahIrigasi/(:num)', 'Irigasi::simpanUbahDaerahIrigasi/$1');
$routes->delete('Irigasi/hapusDaerahIrigasi/(:num)', 'Irigasi::hapusDaerahIrigasi/$1');
//Bangunan Irigasi
$routes->post('Irigasi/simpanBangunanIrigasi', 'Irigasi::simpanBangunanIrigasi');
$routes->get('Irigasi/ubahBangunanIrigasi/(:num)', 'Irigasi::ubahBangunanIrigasi/$1');
$routes->get('Irigasi/simpanUbahBangunanIrigasi/(:num)', 'Irigasi::simpanUbahBangunanIrigasi/$1');
$routes->delete('Irigasi/hapusBangunanIrigasi/(:num)', 'Irigasi::hapusBangunanIrigasi/$1');

//Login
$routes->get('Login', 'Login::index');
$routes->post('Login/process', 'Login::process');
$routes->get('Login/logout', 'Login::logout');


//Shapefile
$routes->get('download-shp/(:num)', 'Shapefile::convertToSHP/$1');


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
