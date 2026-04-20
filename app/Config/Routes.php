<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

$routes->get('/blog', 'Blog::index');
$routes->get('/blog/category/(:segment)', 'Blog::category/$1');
$routes->get('/blog/post/(:segment)', 'Blog::post/$1');
