<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

//user routes
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth-all']);
$routes->get('/admin/dashboard', 'DashboardAdmin::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/profile', 'Users::profile', ['filter' => 'auth-all']);
$routes->match(['get', 'post'], '/login', 'Users::index', ['filter' => 'no-auth']);
$routes->match(['get','post'], '/register', 'Users::register', ['filter' => 'no-auth']);
$routes->get('/logout', 'Users::logout', ['filter' => 'auth-all']);


//role routes
$routes->get('/roles', 'Roles::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/roles/create', 'Roles::create', ['filter' => 'auth']);
$routes->match(['get','post'], '/roles/update', 'Roles::update', ['filter' => 'auth']);
$routes->get('/roles/edit/(:num)', 'Roles::edit/$1', ['filter' => 'auth']);
$routes->get('/roles/delete/(:num)', 'Roles::delete/$1', ['filter' => 'auth']);


//category routes
$routes->get('/categories', 'Categories::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/categories/create', 'Categories::create', ['filter' => 'auth']);
$routes->get('/categories/edit/(:num)', 'Categories::edit/$1', ['filter' => 'auth']);
$routes->match(['get','post'], '/categories/update', 'Categories::update', ['filter' => 'auth']);
$routes->get('/categories/delete/(:num)', 'Categories::delete/$1', ['filter' => 'auth']);


//subcategory routes
$routes->get('/subcategories', 'Subcategories::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/subcategories/create', 'Subcategories::create', ['filter' => 'auth']);
$routes->get('/subcategories/edit/(:num)', 'Subcategories::edit/$1', ['filter' => 'auth']);
$routes->match(['get','post'], '/subcategories/update', 'Subcategories::update', ['filter' => 'auth']);
$routes->get('/subcategories/delete/(:num)', 'Subcategories::delete/$1', ['filter' => 'auth']);


//product routes
$routes->get('/products', 'Products::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/products/create', 'Products::create', ['filter' => 'auth']);
$routes->match(['get','post'], '/products/category', 'Products::category', ['filter' => 'auth']);
$routes->get('/products/edit/(:num)', 'Products::edit/$1', ['filter' => 'auth']);
$routes->match(['get','post'], '/products/update', 'Products::update', ['filter' => 'auth']);
$routes->get('/products/delete/(:num)', 'Products::delete/$1', ['filter' => 'auth']);


//admin user routes
$routes->get('/admin-user', 'AdminUser::index', ['filter' => 'auth']);
$routes->match(['get','post'], '/admin-user/create', 'AdminUser::create', ['filter' => 'auth']);
$routes->get('/admin-user/edit/(:num)', 'AdminUser::edit/$1', ['filter' => 'auth']);
$routes->match(['get','post'], '/admin-user/update', 'AdminUser::update', ['filter' => 'auth']);
$routes->get('/admin-user/delete/(:num)', 'AdminUser::delete/$1', ['filter' => 'auth']);

//buyer routes
$routes->get('/wallet', 'Wallet::index', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/wallet/create', 'Wallet::create', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/wallet/recharge', 'Wallet::recharge', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/home/category', 'Home::category');
$routes->match(['get','post'], '/home/subcategory', 'Home::subcategory');
$routes->match(['get','post'], '/home/sort', 'Home::sort');
$routes->get('/purchase-history', 'Orders::history', ['filter' => 'auth-user']);

//orders routes
$routes->get('/orders', 'Orders::index', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/orders/create', 'Orders::create', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/orders/add', 'Orders::add', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/orders/remove', 'Orders::remove', ['filter' => 'auth-user']);
$routes->match(['get','post'], '/orders/order', 'Orders::order', ['filter' => 'auth-user']);


//API User routes
$routes->get('/api-user/read', 'ApiUser::index', ['filter' => 'auth-apiuserandadmin']);
$routes->match(['get', 'post'],'/api-user/create', 'ApiUser::create', ['filter' => 'auth-apiuserandadmin']);
$routes->get('/api-user/delete/(:num)', 'ApiUser::delete/$1', ['filter' => 'auth-apiuserandadmin']);


// API Product routes
$routes->get('/api-product/read', 'ApiProducts::index', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/api-product/create', 'ApiProducts::create', ['filter' => 'auth']);
$routes->get('/api-product/delete/(:num)', 'ApiProducts::delete/$1', ['filter' => 'auth']);


//API Product path routes
$routes->get('/api-product-path/read', 'ApiProductPath::index', ['filter' => 'auth-apiuserandadmin']);
$routes->match(['get', 'post'],'/api-product-path/create', 'ApiProductPath::create', ['filter' => 'auth']);
$routes->get('/api-product-path/delete/(:num)', 'ApiProductPath::delete/$1', ['filter' => 'auth']);

//API Token routes
$routes->get('/api-token/read', 'ApiTokens::index', ['filter' => 'auth-apiuserandadmin']);
$routes->match(['get', 'post'],'/api-token/create', 'ApiTokens::create', ['filter' => 'auth-apiuser']);
$routes->get('/api-token/delete/(:num)', 'ApiProductPath::delete/$1', ['filter' => 'auth-apiuser']);


// API access routes
$routes->group("api", function ($routes) {

    $routes->post("register", "Api::register");
    
    //API Products access routes
    $routes->get('products', 'Api::index');
    $routes->get('products/(:num)', 'Api::show/$1');
    $routes->get('products/category/(:num)', 'Api::p_category/$1');
    $routes->get('products/subcategory/(:num)', 'Api::p_subcategory/$1');
    
    //API User access routes
    $routes->get('users', 'Api::all_users');
    $routes->get('users/(:num)', 'Api::u_show/$1'); //user by id
    $routes->get('users/email/(:segment)', 'Api::u_show_e/$1'); //user by email
    $routes->get('users/gender/(:segment)', 'Api::u_show_g/$1'); //user by gender
    
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
