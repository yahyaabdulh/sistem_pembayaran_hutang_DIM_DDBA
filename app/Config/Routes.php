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
$routes->get('/', 'Home::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');

$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

$routes->get('/pengguna', 'User::index');
$routes->get('/pengguna/tambah', 'User::create');
$routes->post('/pengguna/simpan', 'User::store');
$routes->get('/pengguna/edit/(:any)', 'User::edit/$1');
$routes->post('/pengguna/update/(:any)', 'User::update/$1');
$routes->get('/pengguna/hapus/(:any)', 'User::delete/$1');

$routes->get('/supplier', 'Supplier::index');
$routes->get('/supplier/tambah', 'Supplier::create');
$routes->post('/supplier/simpan', 'Supplier::store');
$routes->get('/supplier/edit/(:num)', 'Supplier::edit/$1');
$routes->post('/supplier/update/(:num)', 'Supplier::update/$1');
$routes->get('/supplier/hapus/(:num)', 'Supplier::delete/$1');

$routes->get('/pembelian', 'Purchase::index');
$routes->get('/pembelian/tambah', 'Purchase::create');
$routes->post('/pembelian/simpan', 'Purchase::store');
$routes->get('/pembelian/hapus/(:num)', 'Purchase::delete/$1');

$routes->get('/pembayaran', 'Payment::index');
$routes->get('/pembayaran/tambah', 'Payment::create');
$routes->post('/pembayaran/simpan', 'Payment::store');
$routes->get('/pembayaran/hapus/(:num)', 'Payment::delete/$1');

$routes->get('/laporan_hutang', 'Report::index');
$routes->get('/laporan_hutang/export', 'Report::export');


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
