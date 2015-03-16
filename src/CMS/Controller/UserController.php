<?php

namespace CMS\Controller;

use Symfony\Component\HttpFoundation\Request;
use CMS\Model\User;
use Arch\Security\User\Encoder;
use CMS\Service\CheckInfoService;
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
    
    public function isUsernameAvailableAction($request){
        if($request->getMethod() == 'POST' && $request->isXmlHttpRequest()){
            $username = $request->get('username');
            if(!$username){
                return new \Symfony\Component\HttpFoundation\JsonResponse('false');
            }
            
            $result = $this->getDatabaseManager()->getFinder('CMS\Model\User')->getBy(array('username' => $username));
            if($result){
                return new \Symfony\Component\HttpFoundation\JsonResponse('false');
            }else{
                return new \Symfony\Component\HttpFoundation\JsonResponse('true');
            }
        }
        
    }
    
    public function registerDisplayFormPostAction(Request $request){
        // Control on data from the User
        
        
        if($request->getMethod() == 'POST') {
            $control = true;

            

            if(!CheckInfoService::isPassSame($request->get('password_1'),$request->get('password_2'))){
                $this->session->getFlashBag()->add('error_register','Les mots de passe sont differents');
                $control = false;
            }

            if(!CheckInfoService::checkSizeBetween($request->get('password_1'), 16, 8)){
                $this->session->getFlashBag()->add('error_register','Le mot de passe doit être compris entre 8 et 16 caractères');
                $control = false;
            }
            
            
            if(!CheckInfoService::checkSizeBetween($request->get('username'), 16)){
                $this->session->getFlashBag()->add('error_register','Le username ne doit pas faire plus de 16 caractère');
                $control = false;
            }
            
            if(!CheckInfoService::checkSizeBetween($request->get('firstName'), 16)){
                $this->session->getFlashBag()->add('error_register','Le prénom ne doit pas faire plus de 16 caractère');
                $control = false;
            }
            
            if(!CheckInfoService::checkSizeBetween($request->get('lastName'), 16)){
                $this->session->getFlashBag()->add('error_register','Le nom ne doit pas faire plus de 16 caractère');
                $control = false;
            }
            
            
            if(!CheckInfoService::checkEmail(($request->get('email')))){
                $this->session->getFlashBag()->add('error_register','Le format d\'email n\'est pas valide');
                $control = false;
            }

            if(!CheckInfoService::checkUsermame($request->get('username'))){
                $this->session->getFlashBag()->add('error_register','Le username n\'est pas valide, veuillez utiliser des lettres ou des chiffres' );
                $control = false;
            }
            if($request->files->get('img')){
            
                if(!CheckInfoService::checkFileSize($request->files->get('img'), 1000000)){
                    $this->session->getFlashBag()->add('error_register','L\'image pour le profile est trop lourde' );
                    $control = false;
                }

                if(!CheckInfoService::checkFileExtensionAllowed($request->files->get('img'), array('png','jpg'))){
                    $this->session->getFlashBag()->add('error_register','Charger une image' );
                    $control = false;
                }
            }else{
                $this->session->getFlashBag()->add('error_register','Charger une image' );
            }
            
            /** @var $db Arch\Connect\DatabaseManager */
            $db = $this->getDatabaseManager();
            $sql = <<<EOF
                    SELECT *
                    FROM User
                    WHERE
                     username = :username
                    or email = :email
EOF;
           
            $query = $db->getConnect()->prepare($sql);
            $userCheck = $query->execute(array('email' => $request->get('email'),'username' => $request->get('username')));
            if( count($query->fetchAll()) != 0 ){
                $this->session->getFlashBag()->add('error_register','Username déjà utilisé');
                $control = false;
            }



            if(!$control){
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
            return $this->redirect('home');
        }
        return $this->redirect('user_register');
    }
}