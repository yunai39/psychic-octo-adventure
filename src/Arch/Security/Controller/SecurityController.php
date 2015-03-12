<?php
namespace Arch\Security\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Arch\Controller;

class SecurityController extends Controller{

	
	public function logoutAction(Request $request){
		$this->session->remove('user');
 		return $this->redirect('login');
	}
	
	public function logCheckAction(Request $request){
		if($request->getMethod() == 'POST'){
			$username = $request->get('username');
			$password = $request->get('password');
			try{
				$userProvider = new $this->configuration['security']['user_provider']($this->getDatabaseManager());
				$user = $userProvider->authentificate($username,$password,$this->configuration['security']['user_encoder']);
				
                                $this->session->setUser($user);
                                if($request->isXmlHttpRequest()){
                                    return JsonResponse('true');
                                }
                                return $this->redirect('home');
			}catch(\Exception $e){
				$this->session->getFlashBag()->add('login_error',$e->getMessage());
                                return $this->redirect('login');
                                if($request->isXmlHttpRequest()){
                                    return JsonResponse('false');
                                }
			}
		}
	}
}
