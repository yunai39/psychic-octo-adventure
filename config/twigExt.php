<?php 
use Arch\Twig\TwigUrlGenerator;
use Arch\Twig\TwigAsset;

$loader = new Twig_Loader_Filesystem('../src/CMS/View');
$twig = new Twig_Environment($loader, array(
  // For now no cache as this is too annoying for devellopement
//  'cache' => '../cache/',
));
$twig->addGlobal('session', $session);
$twig->addExtension(new  TwigUrlGenerator($generator));
$twig->addExtension(new TwigAsset());