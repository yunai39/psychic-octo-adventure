<?php
 
// example.com/src/app.php
 
use Arch\Routing;

 
$routes = new Routing\RouteCollection();

/*
 * Gestion Routing
 */
$routes->add('home', new Routing\Route(  'CMS\\Controller\\HomeController::indexAction'));


return $routes;