<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Arch\Twig\TwigUrlGenerator;
use Arch\Twig\TwigConnected;
use Arch\Twig\TwigAsset;
use Arch\Routing;
use Arch\Session;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../config/routing.php';

$matcher = new Routing\UrlMatcher($routes);
$generator = new Routing\UrlGenerator($routes);
$session = new Session();


//Ajout des twig
include('../config/twigExt.php');
include('../config/config.php');
$framework = new Arch\Framework($matcher, $generator,$twig,$session,$config);
$response = $framework->handle($request);
$response->send();