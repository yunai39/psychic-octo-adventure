<?php

namespace Arch\Twig;

/**
 * TwigConnected
 * This class is a twig extention to get url generation from twig
 */
class TwigUrlGenerator extends \Twig_Extension
{
	
    /**
    * Simplex\Routing\UrlGenerator Generator  
	* @access       protected
    * @var Simplex\Routing\UrlGenerator $generator
    */
	protected $generator;
	

	/**
	* __construct
	*
	* This function is the constructor for the TwigUrlGenerator
	*
	* @param        UrlGenerator    		$generator    	The url generator
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct($generator){
		$this->generator = $generator;	
	}
	
    public function getFunctions()
    {
        return array(
            'urlgenerator' => new \Twig_Function_Method($this, 'urlgenerator'),
        );
    }

	/**
	* urlgenerator
	*
	* This function will generate the url
	*
	* @param        string   $name    name of the road
	* @param        array   $parameters    parameters for the url
	* @param        bool   $absolute   Whether the url should be absolute or no (not implemented yet)
	* @return 		string 	the url generated
	* @access       public
	* @author       Marine BENOIT
	*/
    public function urlgenerator($name, $parameters = array(), $absolute = false)
    {
        return $this->generator->getUrl($name, $parameters);
    }

    public function getName()
    {
        return 'url_generator';
    }
}