<?php
namespace Arch\Routing;

class RoutingException extends \ErrorException{
	public function __construct() {
    	parent::__construct('The page you are asking for was not found', 404);
	}
	
	
	
	  public function __toString()
	  {
	    switch ($this->severity)
	    {
	      case E_USER_ERROR : // Si l'utilisateur émet une erreur fatale;
	        $type = 'Fatal Error';
	        break;
	      
	      case E_WARNING : // Si PHP émet une alerte.
	      case E_USER_WARNING : // Si l'utilisateur émet une alerte.
	        $type = 'Warning';
	        break;
	      
	      case E_NOTICE : // Si PHP émet une notice.
	      case E_USER_NOTICE : // Si l'utilisateur émet une notice.
	        $type = 'Note';
	        break;
	      
	      default : // Erreur inconnue.
	        $type = 'Unknown error';
	        break;
	    }
	    
	    return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> on lign <strong>' . $this->line . '</strong>';
	 }
}
