<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Main
$routes->get('/', 'Users::index');

// Authentication
$routes->get('login', 'Authentication::login');
$routes->post('login', 'Authentication::loginPost');
$routes->get('/signup', 'Authentication::signup');
$routes->post('/signup', 'Authentication::signupPost');
$routes->post('logout', 'Authentication::logout');

// Admin
$routes->get('/admin/dashboard', 'AdminDashboard::index');
$routes->get('admin/users', 'AdminUsers::index');
$routes->get('admin/pets', 'AdminPets::index');
$routes->get('admin/users/edit/(:num)', 'AdminUsers::edit/$1');
$routes->post('admin/users/update/(:num)', 'AdminUsers::update/$1');
$routes->post('admin/users/delete/(:num)', 'AdminUsers::delete/$1');

//Profile
$routes->get('profile', 'Profile::index');
$routes->get('/profile/settings', 'Profile::settings');
$routes->post('/profile/settings', 'Profile::updateSettings');

// User Pet Management
$routes->get('/pet/edit/(:num)', 'UserPetController::edit/$1');
$routes->post('profile/pet/update/(:num)', 'UserPetController::update/$1');
$routes->post('profile/pet/delete/(:num)', 'UserPetController::delete/$1');


//Request
$routes->get('adopt', 'Adopt::index');
$routes->post('adopt/request', 'Adopt::adoptRequest');

// News
$routes->get('news', 'Users::news');
$routes->get('news/moodboard', 'Users::moodboard');
$routes->get('news/roadmap', 'Users::roadmap');
