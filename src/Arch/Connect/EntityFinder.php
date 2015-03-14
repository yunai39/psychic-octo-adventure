<?php

namespace Arch\Connect;

class EntityFinder{
	protected $db;
	protected $entityClass;
	public function __construct($entityClass,$db){
		$this->db =  $db;
		$this->entityClass = $entityClass;
	}
	
        /**
         * 
         * @param type $id
         * @return Arch\Connect\Entity
         */
	public function get($id){
            return NULL;
	}
	
	public function getBy(array $array, $extra = NULL){
            return NULL;
	}
	
	public function getAll(){
            return NULL;
	}
}
