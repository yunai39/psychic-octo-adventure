<?php
namespace CMS\Model;
use Arch\Connect\Entity;
use Arch\Security\User\UserInterface;
class User extends Entity implements UserInterface{
	
	protected $id;	
	protected $password;
	protected $salt;
	protected $roles;
	protected $username;
	protected $firstName;
	protected $lastName;
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	
	
	public function setPassword($password){
		$this->password = $password;
		return $this;
	}
	
	public function getPassword(){
		return $this->password;
	}
	public function setSalt($salt){
		$this->salt = $salt;
		return $this;
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
	
	
	
	public function setLastName($lastName){
		$this->lastName = $lastName;
		return $this;
	}
	
	public function getLastName(){
		return $this->lastName;
	}	
	
	public function setFirstName($firstName){
		$this->firstName = $firstName;
		return $this;
	}
	
	public function getFirstName(){
		return $this->firstName;
	}
	
	public function setEmail($email){
		$this->email = $email;
		return $this;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setRoles($roles){
		$this->roles = $roles;
		return $this;
	}
	
	public function addRole($role){
		$roles = unserialize($this->roles);
		if(is_array($roles)){
			if(!in_array($role, $roles)){
				$roles[] = $role;
			}
		}else{
			$roles = array();
			$roles[] = $role;
		}
		
		$this->roles = serialize($roles);
		return $this;
	}
	
	public function getRoles(){
		return unserialize($this->roles);
	}
	
	public function hasRole($role){
		return in_array($role, unserialize($this->roles));
	}
	
	
	public function unique_md5() {
            mt_srand(microtime(true)*100000 + memory_get_usage(true));
            return substr(md5(uniqid(mt_rand(), true)),0,15);
	}
        
        
    public static function getTableName() {
        return 'User';
    }
	 
}
