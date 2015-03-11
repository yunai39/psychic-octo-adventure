<?php
namespace CMS\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use CMS\Model\Membre;

class HomeController extends \Arch\Controller{
    public function indexAction($request){
        $db = $this->getDatabaseManager();
        $newMembre = new Membre();
        $newMembre->setLogin('a')->setNom('lola')->setPrenom('zaza');
        $db->add($newMembre);
        $membres = $db->getFinder('CMS\Model\Membre')->getAll();
        return $this->render('Default/home.html.twig', array('membres' => $membres));
    }
    public function helloAction($request){
 		return $this->render('Default/hello.html.twig', array('name' => $request->get('name')));
    }
}