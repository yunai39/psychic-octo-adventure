<?php

namespace Arch\Connect;
use Arch\Connect\Entity;

class DatabaseManager{
	protected $dbs;
	protected $config;
	protected $finders;
	protected $connect;
	
	public function __construct($databaseInfo){
		$this->config = $databaseInfo;
		$finder = array();
	}
	
        /**
         * 
         * @param type $dbName
         * @return Arch\Connect\Connect
         */
	public function getConnect($dbName = 'default'){ return NULL; 	}
	
        
	public function add(Entity $entity){ return NULL; 	}
	
	public function update($entity){return NULL;	}
	
        /**
         * 
         * @param type $entityClass
         * @return null
         */
	public function getFinder($entityClass){return NULL; }
}
