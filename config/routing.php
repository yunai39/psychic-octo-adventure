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

$routes->add('user_profil_current', new Routing\Route(  'CMS\\Controller\\UserController::infoUserCurrentAction','ROLE_USER'));
$routes->add('user_profil', new Routing\Route(  'CMS\\Controller\\UserController::infoUserAction','ROLE_USER', array('id')));
$routes->add('user_register', new Routing\Route( 'CMS\\Controller\\UserController::registerDisplayFormAction'));
$routes->add('user_register_post', new Routing\Route( 'CMS\\Controller\\UserController::registerDisplayFormPostAction'));
$routes->add('user_username_available', new Routing\Route( 'CMS\\Controller\\UserController::isUsernameAvailableAction'));

// Forum
$routes->add('forum', new Routing\Route( 'CMS\\Controller\\ForumController::indexAction', 'NO_ROLE', array('id') ));
$routes->add('forum_topic', new Routing\Route( 'CMS\\Controller\\ForumController::displayTopicAction', 'NO_ROLE', array('id')));
$routes->add('forum_new_topic', new Routing\Route( 'CMS\\Controller\\ForumController::newTopicAction', 'ROLE_USER'));
$routes->add('forum_send_message', new Routing\Route( 'CMS\\Controller\\ForumController::sendMessageAction', 'ROLE_USER'));



return $routes;