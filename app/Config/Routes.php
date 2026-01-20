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
    $routes->post('services', 'ServiceController::DataTable');
    $routes->get('services/create', 'ServiceController::create');
    $routes->post('services/store', 'ServiceController::store');
    $routes->get('services/edit/(:num)', 'ServiceController::edit/$1');
    $routes->post('services/update', 'ServiceController::update');
    $routes->post('services/delete', 'ServiceController::delete');

// discount
    $routes->get('discount', 'DiscountController::index');
    $routes->post('discount', 'DiscountController::datatable');
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
    $routes->post('reservation','ReservationController::datatable');
    $routes->get('reservation/create', 'ReservationController::create');
    $routes->post('reservation/store', 'ReservationController::store');
    $routes->get('reservation/edit/(:num)', 'ReservationController::edit/$1');
    $routes->post('reservation/update', 'ReservationController::update');
    $routes->post('delete', 'ReservationController::delete');


    $routes->get('user', 'UserController::index');

    $routes->get('user/create', 'UserController::create');
    $routes->post('user', 'UserController::datatable');

    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/store', 'UserController::store');
    $routes->post('user/update', 'UserController::update');
    $routes->post('user/delete', 'UserController::delete');
    $routes->get('hotel', 'HotelController::index');

    // Show create hotel form
    $routes->get('hotel/create', 'HotelController::create');
    $routes->post('hotel/store', 'HotelController::store');
    $routes->post('hotel', 'HotelController::DataTable');

     $routes->get('hotel/edit/(:num)', 'HotelController::edit/$1');
//   $routes->post('update', 'HotelController::update');
     $routes->post('hotel/update', 'HotelController::update');
     $routes->post('hotel/delete', 'HotelController::delete');
     $routes->get('rooms', 'RoomsController::index');
      $routes->get('room/create', 'RoomsController::create');

    // Store new room
    $routes->post('room/store', 'RoomsController::store');
     $routes->post('rooms', 'RoomsController::DataTable');
    // Show room details
    $routes->get('room/(:num)', 'RoomsController::show/$1');
    $routes->post('room', 'RoomsController::updateStatus');

    // Show edit room form
    $routes->get('room/edit/(:num)', 'RoomsController::edit/$1');

    // Update room
    $routes->post('room/update', 'RoomsController::update');

    // Delete room
    $routes->post('room/delete', 'RoomsController::delete');




service('auth')->routes($routes);

