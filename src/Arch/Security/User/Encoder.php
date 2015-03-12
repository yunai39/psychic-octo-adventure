<?php
namespace Arch\Security\User;

class Encoder{
	protected $hashAlgo;
	
	public function __construct($algo = 'md5'){
		if(in_array($algo, hash_algos()))
			$this->hashAlgo = $algo;
		else {
			// Maybe send an error
			$this->hashAlgo = 'md5';
		}
	}
	
	public function hashPass($pass,$salt){
		return hash($this->hashAlgo, $salt.$pass);
	}
	
	public function checkPass($passRaw, $passHash, $salt){
            
		return ($this->hashPass($passRaw, $salt) === $passHash);
	}
}
