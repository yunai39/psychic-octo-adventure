<?php

namespace Arch;

use Arch\FlashBag;

class Session {
	protected $flashBag;
	public function __construct(){
		session_start();
		$this->flashBag = new FlashBag();
	}
	
	public function getFlashBag(){
		return $this->flashBag;
	}
	
	public function set($key,$value){
		$_SESSION[$key] = $value;
	}
	
	public function has($key){
		return isset($_SESSION[$key]);	
	}
	
	public function get($key){
		return $_SESSION[$key];
	}
	
	public function remove($key){
		unset($_SESSION[$key]);
	}
	
	public function clear(){
		session_destroy();
	}
	
	public function hasUser(){
		if(isset($_SESSION['user'])){
			return true;
		}
		return false;
	}
	
	public function getUser(){
		if(isset($_SESSION['user'])){
			return unserialize($_SESSION['user']);
		}
		return false;
	}
	
	public function setUser($user){
		$_SESSION['user'] = serialize($user);
	}
}
