<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
$routes->get('/', 'Front_Home::index');
$routes->get('/web-admin', 'AdminHome::index');
$routes->post('/admin-login', 'Login::admin');



$routes->post("/form/(:any)","Form::action_update/$1");
$routes->group('',['filter'=>'AuthCheck'], function($routes){
    $routes->get('/web-admin/user/user_access', 'Admin_user::view');    
    
    $routes->post('/web-admin/slogan/(:any)', 'Slogan::action_update/$1');
    $routes->post('/web-admin/menu/(:any)', 'Menu::action_update/$1');
    $routes->post('/web-admin/slide/(:any)', 'Slide::action_update/$1');
    $routes->post('/web-admin/web_settings/(:any)', 'Web_Settings::action_update/$1');
    $routes->post('/web-admin/gallery/(:any)', 'Gallery::action_update/$1');
    $routes->post('/web-admin/about/(:any)', 'About::action_update/$1');
    $routes->post('/web-admin/service/(:any)', 'Service::action_update/$1');
    $routes->post('/web-admin/slider/(:any)', 'Slider::action_update/$1');
    $routes->post('/web-admin/user/(:any)', 'Admin_user::action_update/$1');
    $routes->match(["get","post"],'/web-admin/(:any)', 'Admin::view/$1');

});
