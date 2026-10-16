<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
|--------------------------------------------------------------------------
| Main / Public Pages
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Users::index');

$routes->get('about', 'Users::about');
$routes->get('contact', 'Users::contact');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$routes->get('login', 'Authentication::login');
$routes->post('login', 'Authentication::loginPost');

$routes->get('signup', 'Authentication::signup');
$routes->post('signup', 'Authentication::signupPost');

$routes->post('logout', 'Authentication::logout');


/*
|--------------------------------------------------------------------------
| Products & Collections
|--------------------------------------------------------------------------
*/

// Collections
$routes->get('collections', 'Collections::index');
$routes->get('collections/(:num)', 'Collections::show/$1');

// Products
$routes->get('products', 'Products::index');
$routes->get('products/(:num)', 'Products::show/$1');


/*
|--------------------------------------------------------------------------
| Shopping Cart
|--------------------------------------------------------------------------
*/

$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update');
$routes->post('cart/remove', 'Cart::remove');
$routes->post('cart/clear', 'Cart::clear');


/*
|--------------------------------------------------------------------------
| Checkout / Orders
|--------------------------------------------------------------------------
*/

$routes->get('checkout', 'Orders::checkout');
$routes->post('checkout', 'Orders::create');

$routes->get('orders/confirmation/(:num)', 'Orders::confirmation/$1');
$routes->get('orders/(:num)', 'Orders::show/$1');


/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/

$routes->get('profile', 'Profile::index');

$routes->get('profile/settings', 'Profile::settings');
$routes->post('profile/settings', 'Profile::updateSettings');

$routes->get('profile/orders', 'Profile::orders');
$routes->get('profile/orders/(:num)', 'Profile::order/$1');


/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/

$routes->get('notifications', 'Notifications::index');
$routes->post('notifications/read/(:num)', 'Notifications::markAsRead/$1');
$routes->post('notifications/read-all', 'Notifications::markAllAsRead');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

// Dashboard
$routes->get('admin/dashboard', 'AdminDashboard::index');

// Orders
$routes->get('admin/orders', 'AdminOrders::index');
$routes->get('admin/orders/(:num)', 'AdminOrders::show/$1');
$routes->post('admin/orders/(:num)/status', 'AdminOrders::updateStatus/$1');

// Products
$routes->get('admin/products', 'AdminProducts::index');
$routes->get('admin/products/create', 'AdminProducts::create');
$routes->post('admin/products/create', 'AdminProducts::store');
$routes->get('admin/products/edit/(:num)', 'AdminProducts::edit/$1');
$routes->post('admin/products/edit/(:num)', 'AdminProducts::update/$1');
$routes->post('admin/products/delete/(:num)', 'AdminProducts::delete/$1');

// Collections
$routes->get('admin/collections', 'AdminCollections::index');
$routes->get('admin/collections/create', 'AdminCollections::create');
$routes->post('admin/collections/create', 'AdminCollections::store');
$routes->get('admin/collections/edit/(:num)', 'AdminCollections::edit/$1');
$routes->post('admin/collections/edit/(:num)', 'AdminCollections::update/$1');
$routes->post('admin/collections/delete/(:num)', 'AdminCollections::delete/$1');


/*
|--------------------------------------------------------------------------
| Jotform API Integration
|--------------------------------------------------------------------------
*/

// Internal route used by the application to trigger
// synchronization of a completed order to Jotform.
$routes->post('api/jotform/orders/(:num)', 'JotformController::syncOrder/$1');