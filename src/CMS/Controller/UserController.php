<?php

namespace CMS\Controller;

use Symfony\Component\HttpFoundation\Request;
use CMS\Model\User;
use Arch\Security\User\Encoder;
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
    
    public function registerDisplayFormAction(Request $request){
        return $this->render('Users/formRegister.html.twig');
    }
    
    
    public function registerDisplayFormPostAction(Request $request){
        // Control on data from the User
        
        
        /** @var $db Arch\Connect\DatabaseManager */
        $db = $this->getDatabaseManager();
        $userCheck = $db->getFinder('CMS\Model\User')->getBy(array('username' => $request->get('username')));
        if($userCheck){
            $this->session->getFlashBag()->add('error_register','Username déjà utilisé');
            return $this->render('Users/formRegister.html.twig');
        }
        $user = new User();
        $password_raw= $request->get('password_1');
        $user->setSalt($user->unique_md5());
        $encoder = new Encoder();
        $user->setPassword($encoder->hashPass($password_raw, $user->getSalt()));
        
        $user->setUsername($request->get('username'))
             ->setLastName($request->get('lastName'))
             ->setFirstName($request->get('firstName'))
             ->setEmail($request->get('email'))
             ->addRole('ROLE_USER');
        $user->upload($request->files->get('img'));
        $db->add($user);
        return $this->render('Users/formRegister.html.twig');
    }
}