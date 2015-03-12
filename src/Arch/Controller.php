<?php
namespace Arch;

use Twig_Environment;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller
 * This class is an implementation of controller
 */
class Controller{
    /**
    * Twig_Environment Twig  
	* @access       protected
    * @var Twig_Environment $twig
    */
	protected $twig;
	
    /**
    * Arch\Routing\UrlGenerator Generator  
	* @access       protected
    * @var Arch\Routing\UrlGenerator $generator
    */
	protected $urlGenerator;
	
    /**
    * Symfony\Component\HttpFoundation\Session\Session session  
	* @access       protected
    * @var Session $seesion
    */
	protected $session;

	/**
	 * Configuration array
	 * @var	array 	$configuration
	 */
	protected $configuration;
	
	

	
	/**
	* setTwig
	*
	*
	* @param        Twig_Environnement    $twig    Twig environnement
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setTwig($twig){
		$this->twig = $twig;	
		return $this;
	}
	
	
	
	public function decode($array){
		
		foreach ($array as $key => $value) {
			if(is_array($value)){
				$array[$key] = $this->decode($value);
			}
			else{
				$array[$key] = utf8_encode($value);
			}
			return $array;
		}
	}
	/**
	* setSession
	*
	*
	* @param        Arch\Session    $session    The session
        * @return       Arch\Controller 
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setSession($session){
		$this->session = $session;	
		return $this;
	}
	
	/**
	* setUrlGenerator
	*
	*
	* @param        Arch\Routing\UrlGenerator    $urlGenerator    Url generator
        * @return       Arch\Controller 
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setUrlGenerator($urlGenerator){
		$this->urlGenerator = $urlGenerator;
                return $this;
	}

	public function setConfiguration($configuration){
		$this->configuration = $configuration;
		return $this;
	}
	/**
	* render
	*
	*
	* @param        string    $view    path to the view
	* @param        array    $parameters    array of parameters
	* @param		Response $response
	* @access       public
	* @author       Marine BENOIT
	*/
	public function render($view, array $parameters = array(), Response $response = null)
        {
    	//$parameters = $this->decode($parameters);
		$template = $this->twig->loadTemplate($view);
		return $template->display($parameters);
        }
	
	/**
	* redirect
	* Redirection 
	*
	* @param        string    $action    name of the road
	* @param        array    $arg    array of arguments
	* @access       public
	* @author       Marine BENOIT
	*/
	public function redirect($action, $arg = null){
                return new RedirectResponse($this->urlGenerator->getUrl($action , $arg));
		//header('Location: '.$this->urlGenerator->getUrl($action , $arg));  
	}
	/**
         * 
         * @return boolean
         */
	public function getUser(){
		if($this->session->has('user')){
			return unserialize($this->session->get('user'));
		}
		else return false;
	}
	
        /**
         * 
         * @return type
         */
	public function getDirectoryRoot(){
		
		return __DIR__.'/../../';
	}
	
        /**
         * 
         * @param type $databaseName
         * @return Arch\Connect\DatabaseManager
         */
	public function getDatabaseManager($databaseName = 'default'){
		if(isset($this->databaseManagers[$databaseName])){
			return $this->databaseManagers[$databaseName];
		}
		else{
                    include($this->getDirectoryRoot().'/config/databaseInfo.php');
                    if(isset($databaseInfo[$databaseName])){
                            $managerName = "Arch\Connect\DatabaseManager".$databaseInfo[$databaseName]['type'];
                            $this->databaseManagers[$databaseName] = new $managerName($databaseInfo);
                            return $this->databaseManagers[$databaseName];
                    }else{
                            return NULL;
                    }
		}
	}
}
