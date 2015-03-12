<?php
namespace Arch\Security\User;
use Arch\Security\User\Encoder;
use Arch\Security\User\UserInterface;

class User implements UserInterface{
	protected $password;
	protected $salt;
	protected $roles;
	protected $username;
	
	public function __construct(){
		$this->salt = $this->unique_md5();
		$this->roles = array();
	}
	
	
	public function setPassword($password){
		$this->password = $password;
		return $this;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getSalt(){
		return $this->salt;
	}
	
	public function setUsername($username){
		$this->username = $username;
		return $this;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function addRole($role){
		if(!in_array($role, $this->roles)){
			$this->roles[] = $role;
		}
		return $this;
	}
	
	public function getRoles(){
		return $this->roles;
	}
	
	public function hasRole($role){
		return in_array($role, $this->roles);
	}
	
	
	private function unique_md5() {
    	mt_srand(microtime(true)*100000 + memory_get_usage(true));
    	return substr(md5(uniqid(mt_rand(), true)),0,15);
	}
	 
	 
	
}
