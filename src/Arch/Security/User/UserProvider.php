<?php
namespace Arch\Security\User;
use Arch\Security\User\Encoder;
class UserProvider{
	
	
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
		$user = new User();
		$encoder = new Encoder('md5');
		$user->setPassword($encoder->hashPass('azerty',$user->getSalt()));
		$user->setUsername('admin');
		$user->addRole('ROLE_ADMIN');
		return $user;
	}
	
}

