<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\ServiceController;
/**
 * @var RouteCollection $routes
 */
// frontend
$routes->get('/', 'Home::index');
$routes->get('about', 'About::index');
$routes->get('room', 'Room::index');
$routes->get('news', 'News::index');
$routes->get('contact', 'Contact::index');

    $routes->get('services', 'ServiceController::index');
      $routes->get('services/create', 'ServiceController::create');
       $routes->post('services/store', 'ServiceController::store');
           $routes->get('services/edit/(:num)', 'ServiceController::edit/$1');
    $routes->post('services/update', 'ServiceController::update');
    $routes->post('services/delete', 'ServiceController::delete');
// $routes->group('services', function ($routes) {
//     $routes->get('/', 'ServiceController::index');
//     $routes->get('services/create', 'ServicesController::create');
//     $routes->post('store', 'Dashboard\ServicesController::store');
//     $routes->get('edit/(:num)', 'Dashboard\ServicesController::edit/$1');
//     $routes->post('update', 'Dashboard\ServicesController::update');
//     $routes->post('delete', 'Dashboard\ServicesController::delete');
// });
// discount
$routes->get('discount', 'DiscountController::index');
 $routes->get('discount/create', 'DiscountController::create');
    $routes->post('discount/store', 'DiscountController::store');
    $routes->get('discount/edit/(:num)', 'DiscountController::edit/$1');
    $routes->post('discount/update', 'DiscountController::update');
    $routes->post('discount/delete', 'DiscountController::delete');
// permission
 $routes->get('permission', 'PermissionController::index');

    // Create permission form
    $routes->get('permission/createPermission', 'PermissionController::create');

    // Store permission
    $routes->post('permission/store', 'PermissionController::store');

    // Delete permission
    $routes->post('permission/delete', 'PermissionController::delete');


// reservation
$routes->get('reservation','ReservationController::index');
 $routes->get('reservation/create', 'ReservationController::create');
    $routes->post('reservation/store', 'ReservationController::store');
    $routes->get('edit/(:num)', 'ReservationController::edit/$1');
    $routes->post('update', 'ReservationController::update');
    $routes->post('delete', 'ReservationController::delete');
// $routes->get('signup', 'Signup::index');
// $routes->post('signup', 'Signup::store');
// $routes->get('signup', 'Signup::index');
// $routes->post('signup', 'Signup::index');
// dashboard/user/index
// $routes->get('index', 'UserController::index');
$routes->get('user', 'UserController::index');

$routes->get('user/create', 'UserController::create');
$routes->post('user/store', 'UserController::store');
// $routes->post('hotel', 'HotelController::index');
$routes->get('hotel', 'HotelController::index');

    // Show create hotel form
    $routes->get('hotel/create', 'HotelController::create');
 $routes->post('hotel/store', 'HotelController::store');
//  $routes->get('hotel/eidt', 'HotelController::show');
 $routes->get('hotel/edit/(:num)', 'HotelController::edit/$1');
//   $routes->post('update', 'HotelController::update');
  $routes->post('hotel/update', 'HotelController::update');
    $routes->post('hotel/delete', 'HotelController::delete');
     $routes->get('rooms', 'RoomsController::index');
      $routes->get('room/create', 'RoomsController::create');

    // Store new room
    $routes->post('room/store', 'RoomsController::store');

    // Show room details
    $routes->get('room/(:num)', 'RoomsController::show/$1');

    // Show edit room form
    $routes->get('room/edit/(:num)', 'RoomsController::edit/$1');

    // Update room
    $routes->post('room/update', 'RoomsController::update');

    // Delete room
    $routes->post('room/delete', 'RoomsController::delete');

$routes->group('hotel', function($routes) {
    // List all hotels
    // $routes->get('', 'HotelController::index');

    // // Show create hotel form
    // $routes->get('create', 'HotelController::create');

    // Store new hotel
    // $routes->post('hotel/store', 'HotelController::store');

    // Show hotel details / edit form
    // $routes->get('hotel/eidt', 'HotelController::show');

    // Update hotel
    // $routes->post('update', 'HotelController::update');

    // Soft delete hotel
    // $routes->post('delete', 'HotelController::delete');
});

// $routes->group('dashboard', function($routes) {

//     // User routes
//     $routes->get('Dashboard/User', 'Dashboard\UserController::index'); // dashboard/user -> index.php
//     $routes->get('user/create', 'Dashboard\UserController::create'); // dashboard/user/create
//     $routes->post('user/store', 'Dashboard\UserController::store'); // store new user
//     $routes->get('user/edit', 'Dashboard\UserController::editUser'); // dashboard/user/edit?id=1
//     $routes->post('user/update', 'Dashboard\UserController::update'); // update user
//     $routes->post('user/softDelete', 'Dashboard\UserController::softDelete'); // delete user
// });

service('auth')->routes($routes);

