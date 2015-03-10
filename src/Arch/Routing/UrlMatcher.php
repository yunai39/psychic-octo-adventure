<?php
namespace Arch\Routing;
use Arch\Routing\RouteCollection;
use Arch\Routing\Route;

/**
 * UrlMatcher
 * This class will allow use to get the function associated with each url
 */
class UrlMatcher{
    /**
    * Arch\Routing\RouteCollection Route Collection 
	* @access       protected
    * @var RouteCollection $routeCollection
    */
	protected $routeCollection;

	/**
	* __construct
	*
	* This function is the constructor for the UrlMatcher
	*
	* @param        Arch\Routing\RouteCollection    $routeCollection    The collection of road for the application
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct(RouteCollection $routeCollection){
		$this->routeCollection = $routeCollection;
	}
	
	
	/**
	* getArg
	*
	* This function will return an array of information about the function that need to be used
	*
	* @param        Symfony\Component\HttpFoundation\Request   $request    The request
	* @return 		array 	array of the commonnent needed to find the function
	* @access       public
	* @author       Marine BENOIT
	*/
	public function getArg($request){
		if($request->get('page') == NULL)
			$routeName = 'home';
		else
			$routeName = $request->get('page');
		$route = $this->routeCollection->get($routeName);
		if($route != Null){
			$argumentTab = $route->getArgument();
			$return = array();
			$return['_controller'] = $route->getController();
			if(count($argumentTab) != 0){
				foreach($argumentTab as $key => $value){
					$return[$key] = $request->get($key);
				}
			}
			$return['neededRole'] = $route->neededRole();
			return $return;
		}
		else{
			throw new \Exception();
			
		}
	}
}
