<?php

namespace Arch\Connect;
use Arch\Connect\DatabaseManager;

class EntityFinderPDO extends EntityFinder{
	protected $db;
	protected $entityClass;
	public function __construct($entityClass,$db){
		$this->db =  $db;
		$this->entityClass = $entityClass;
	}
	
	public function get($id){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName." where id=:id";
		$request = $this->db->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
		$request->execute(array( ':id' => $id));
		if(!$request){
			return false;
		}
		$data = $request->fetch(\PDO::FETCH_ASSOC);
                if($data){
                    return new $this->entityClass($data);
                }
                else{
                    return false;
                }
	}
	
	public function getBy(array $array){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName;
		$notFirst = false;
		foreach ($array as $key => $value) {
			if($notFirst){
				$sql .= " AND ";
			}
			else{
				$sql .=" WHERE ";
			}
			$sql .= " ".$key." = :".$key." ";  
		}
		$request = $this->db->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
		$request->execute($array);
		if(!$request){
			return false;
		}
		$entities = array();
		while($data = $request->fetch(\PDO::FETCH_ASSOC)){
			$entities[] = new $this->entityClass($data);
		}
                if(count($entities) == 0){
                    return false;
                }
		return $entities;
	}
	
	public function getAll(){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName;
		$request = $this->db->query($sql);
		if(!$request){
			return false;
		}
		$entities = array();
		while($data = $request->fetch(\PDO::FETCH_ASSOC)){
			$entities[] = new $this->entityClass($data);
		}
                if(count($entities) == 0){
                    return false;
                }
		return $entities;

	}
}
