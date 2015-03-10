<?php

namespace Arch\Twig;


/**
 * TwigConnected
 * This class is a twig extention to check if the user is connected
 */
class TwigAsset extends \Twig_Extension
{
	
	/**
	* __construct
	*
	* This function is the constructor for the TwigConnected
	*
	* @access       public
	* @author       Marine BENOIT
	*/
    public function getFunctions()
    {
        return array(
            'asset' => new \Twig_Function_Method($this, 'asset'),
        );
    }
	/**
	* isConnected
	*
	* This function will return true or false depending if the user is connected
	*
	* @return 		bool 	Whether the user is connected or no
	* @access       public
	* @author       Marine BENOIT
	*/
    public function asset($file = '')
    {
		$url = $_SERVER['REQUEST_URI']; //returns the current URL
		$parts = explode('/',$url);
		$dir = '';
		for ($i = 0; $i < count($parts) - 1; $i++) {
		 $dir .= $parts[$i] . "/";
		}
    	return $dir.$file;
    }

    public function getName()
    {
        return 'asset';
    }
}