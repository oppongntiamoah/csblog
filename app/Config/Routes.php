<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

$routes->get('/blog', 'Blog::index');
$routes->get('/blog/category/(:segment)', 'Blog::category/$1');
$routes->get('/blog/post/(:segment)', 'Blog::post/$1');

// Admin auth (no filter)
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::authenticate');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Admin protected routes
$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Posts
    $routes->get('posts', 'Admin\Posts::index');
    $routes->get('posts/new', 'Admin\Posts::create');
    $routes->post('posts/store', 'Admin\Posts::store');
    $routes->get('posts/edit/(:num)', 'Admin\Posts::edit/$1');
    $routes->post('posts/update/(:num)', 'Admin\Posts::update/$1');
    $routes->post('posts/delete/(:num)', 'Admin\Posts::delete/$1');

    // Categories
    $routes->get('categories', 'Admin\Categories::index');
    $routes->get('categories/new', 'Admin\Categories::create');
    $routes->post('categories/store', 'Admin\Categories::store');
    $routes->get('categories/edit/(:num)', 'Admin\Categories::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Categories::update/$1');
    $routes->post('categories/delete/(:num)', 'Admin\Categories::delete/$1');

    // Ads
    $routes->get('ads', 'Admin\Ads::index');
    $routes->get('ads/new', 'Admin\Ads::create');
    $routes->post('ads/store', 'Admin\Ads::store');
    $routes->get('ads/edit/(:num)', 'Admin\Ads::edit/$1');
    $routes->post('ads/update/(:num)', 'Admin\Ads::update/$1');
    $routes->post('ads/delete/(:num)', 'Admin\Ads::delete/$1');
});
