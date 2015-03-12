<?php

namespace CMS\Service;
use Arch\Security\User\UserProvider;
use Arch\Connect\DatabaseManager;
use Arch\Security\User\Encoder;

class MyUserProvider extends UserProvider{
	
	protected $dm;
	
	public function __construct(DatabaseManager $dm){
		$this->dm = $dm;
	}
	
	public function authentificate( $username,$password,$hash){
		//Check If the user exist
		if(!$user = $this->fetchData($username)){
			throw new \Exception('userDoesNotExist');
		}
		
		
		//get the salt 
		$salt = $user->getSalt();
		$encoder = new Encoder($hash);
                
		if(!$encoder->checkPass($password,$user->getPassword(), $user->getSalt())){
                        
			throw new \Exception('wrongPassword');
		}
		else {
			return $user;
		}
	}
	
	
	/**
	 * This function will fetch the user in the datbase or anything else
	 */
	public function fetchData($username){
		$entityFind = $this->dm->getFinder('CMS\Model\User');
		$user = $entityFind->getBy(array('username' => $username));
		if($user){
			return $user[0];
		}
		return false;
	}
	

}
