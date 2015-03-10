<?php

namespace Arch;

class FlashBag{
	public function __construct(){
		if(!isset($_SESSION['flash'])){
			$_SESSION['flash'] = array();
		}
	}
	
	public function has($key){
		if(isset($_SESSION['flash'][$key])){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function add($key,$value){
		if(isset($_SESSION['flash'][$key])){
			$_SESSION['flash'][$key][] = $value;
		}
		else{
			$_SESSION['flash'][$key] = array();
			$_SESSION['flash'][$key][] = $value;
		}
	}
	
	public function get($key){
		try{
			$retour = $_SESSION['flash'][$key];
			unset($_SESSION['flash'][$key]);
			return $retour;
		}	
		catch(Exception $e){
			return array();
		}
		
	}
}
