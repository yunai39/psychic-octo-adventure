<?php
namespace Arch\Routing;
use Arch\Routing\RouteCollection;
use Arch\Routing\Route;

/**
 * UrlGenerator
 * This class will allow use to get the url for each road, we will mostly use it combined with twig
 */
class UrlGenerator{
    /**
    * Arch\Routing\RouteCollection Route Collection 
	* @access       protected
    * @var RouteCollection $routeCollection
    */
	protected $routeCollection;
	
	/**
	* __construct
	*
	* This function is the constructor for the UrlGenerator
	*
	* @param        Arch\Routing\RouteCollection    $routeCollection    The collection of road for the application
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct(RouteCollection $routeCollection){
		$this->routeCollection = $routeCollection;
	}
	
	/**
	* getUrl
	*
	* This function will return the url based on a array of ellement
	*
	* @param        string   $action    The name of the route we want
	* @param        array   $arg    an array of argument for the url
	* @param        bool   $absolute    if the url generated should be absolute (no yet implemented)
	* @return 		string	the url generated
	* @access       public
	* @author       Marine BENOIT
	*/
	public function getUrl($action , $arg = array(),$absolute = false){
		$url='app.php?page='.$action;
		if(count($arg) != 0){
			foreach($arg as $key => $value){
				$url .= '&'.$key.'='.$value;
			}
		}
		return $url;
	}
}
