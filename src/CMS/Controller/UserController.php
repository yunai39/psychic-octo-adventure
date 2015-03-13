<?php

namespace CMS\Controller;

use Symfony\Component\HttpFoundation\Request;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends \Arch\Controller {
    
    public function infoUserCurrentAction(Request $request){
        return $this->render('Users/showUser.html.twig', array('user' => $this->getSession()->getUser()));
    }
    
    public function infoUserAction(Request $request,$arg){
        
        if(!isset($arg['id']) ){
            throw new \Exception('Pas d\'id');
        }
        $user = $this->getDatabaseManager()->getFinder('CMS\Model\User')->get($arg['id'] );
        if(!$user){
            throw new \Exception('Pas d\'utilisateur');
        }
        return $this->render('Users/showUser.html.twig', array('user' => $user));
    }
}