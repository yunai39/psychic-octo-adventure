<?php
namespace Arch\Connect;
class Entity{
	
	public function __construct(array $data = array()){
		$this->hydrate($data);
	}
	
	public function hydrate(array $data)
	{
	  foreach ($data as $key => $value)
	  {
	    $method = 'set'.ucfirst($key);
	    if (method_exists($this, $method))
            {
    		$this->$method($value);
		}
	  }
	}
	
	public function get($key){
		if(isset($this->$key)){
			return $this->$key;
		}
		return false;
	}
	public function getAttributs(){
		$array =  get_object_vars($this);
		$class = get_called_class();
		return $array;
	}
	
	public function getAttributsClass(){
		return get_object_vars($this);
	}
	
	public static function getTableName(){
	}
	
	public function copy($entity){
		foreach (get_object_vars($this) as  $value)
	  	{
		    $method = 'set'.ucfirst($value);
			$methodG = 'get'.ucfirst($value);
		    if (method_exists($this, $method))
			{
				$this->$method($entity->$methodG());
			}
	  	}
	} 
}
