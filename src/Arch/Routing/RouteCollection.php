<?php
namespace Arch\Routing;

use Arch\Routing\Route;

/**
 * RouteCollection
 * Array of route
 */
class RouteCollection{
	
    /**
    * Array of Route
	* @access       protected
    * @var array $arrayRoute
    */
	protected $arrayRoute;
	
	/**
	* __construct
	*
	* This function is the constructor for the RouteCollection
	*
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct(){
		$arrayRoute = array();
	}
		
	/**
	* add
	*
	* This function will add a route to the collection
	*
	* @access       public
	* @author       Marine BENOIT
	*/
	public function add($name, Route $route){
		$this->arrayRoute[$name] = $route;
	}
		
	/**
	* get
	*
	* This function will get a route from the collection
	*
	* @param		string $name		name of the road
	* @return		Route 				The route founded
	* @access       public
	* @author       Marine BENOIT
	*/
	public function get($name){
		if(isset($this->arrayRoute[$name]))
			return $this->arrayRoute[$name];
		else 
			throw  new \Arch\Routing\RoutingException();
				
	}
}
