<?php
namespace CMS\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeController extends \Arch\Controller{
    public function indexAction($request){
 		return $this->render('Default/home.html.twig');
    }
    public function helloAction($request){
 		return $this->render('Default/hello.html.twig', array('name' => $request->get('name')));
    }
}