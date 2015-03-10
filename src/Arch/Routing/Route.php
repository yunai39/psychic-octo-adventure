<?php
namespace Arch\Routing;


/**
 * Route
 * Every instance is a road associated with a name and an action
 */
class Route{
	
    /**
    * name of the controller and function  
	* @access       protected
    * @var string $controller
    */
	protected $controller;
	
    /**
    * array of arguments  
	* @access       protected
    * @var array $argument
    */
	protected $argument;
	
    /**
    * If the user need to be an admin
	* @access       protected
    * @var bool $needAdmin
    */
	protected $neededRole;
	
	
	/**
	* __construct
	*
	* This function is the constructor for the Framework
	*
	* @param        string    	$controller    	name of the controller and function 
	* @param        bool    	$needAdmin    	if the user need admin right
	* @param        array    	$argument    	Array of argument
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct($controller,$neededRole = 'NO_ROLE', array $argument = null){
		$this->controller = $controller;
		$this->neededRole = $neededRole;
		$this->argument = $argument;
	}
	
	/**
	* getController
	*
	* @return 		string  return the controller
	* @access       public
	* @author       Marine BENOIT
	*/
	public function getController(){
		return $this->controller;
	}
	
	/**
	* getArgument
	*
	* @return 		array  return the argument
	* @access       public
	* @author       Marine BENOIT
	*/
	public function getArgument(){
		return $this->argument;
	}
	
	/**
	* needAdmin
	*
	* @return 		bool  return needAdmin
	* @access       public
	* @author       Marine BENOIT
	*/
	public function neededRole(){
		return $this->neededRole;
	}
	
}
