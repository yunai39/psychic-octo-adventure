<?php
 
// example.com/src/app.php
 
use Arch\Routing;

 
$routes = new Routing\RouteCollection();

/*
 * Gestion Routing
 */
$routes->add('home', new Routing\Route(  'CMS\\Controller\\HomeController::indexAction'));
$routes->add('hello', new Routing\Route(  'CMS\\Controller\\HomeController::helloAction'));
$routes->add('login', new Routing\Route(  'CMS\\Controller\\HomeController::loginAction'));
$routes->add('logout', new Routing\Route(  'Arch\\Security\\Controller\\SecurityController::logoutAction'));
$routes->add('log_check', new Routing\Route(  'Arch\\Security\\Controller\\SecurityController::logCheckAction'));

$routes->add('info_user_current', new Routing\Route(  'CMS\\Controller\\UserController::infoUserCurrentAction','ROLE_USER'));
$routes->add('info_user', new Routing\Route(  'CMS\\Controller\\UserController::infoUserAction','ROLE_USER', array('id')));
return $routes;