<?php
namespace Arch;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Arch\Routing\UrlMatcher;
use Twig_Environment;
use Arch\Routing\RouteCollection;
use Arch\Routing\UrlGenerator;
use Arch\Session;
use CMS;

/**
 * Framework
 * This class will allow use to get the function associated with each url
 */
class Framework
{
	
    /**
    * Arch\Routing\UrlMatcher Matcher  
	* @access       protected
    * @var Arch\Routing\UrlMatcher $matcher
    */
    protected $matcher;

		
    /**
    * Arch\Routing\UrlGenerator Generator  
	* @access       protected
    * @var Arch\Routing\UrlGenerator $generator
    */
	protected $generator;
		
    /**
    * Twig_Environment Twig  
	* @access       protected
    * @var Twig_Environment $twig
    */
	protected $twig;
 
    /**
    * Arch\Session session  
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
	* __construct
	*
	* This function is the constructor for the Framework
	*
	* @param        UrlMatcher    			$matcher    	The road matcher
	* @param        UrlGenerator    		$generator    	The url generator
	* @param        Twig_Environment    	$twig    		Twig environnement
	* @param        Session    				$session    	The session
	* @access       public
	* @author       Marine BENOIT
	*/
    public function __construct(UrlMatcher $matcher, UrlGenerator $generator,Twig_Environment $twig,Session $session, array $configuration)
    {
            $this->matcher = $matcher;
            $this->generator = $generator;
            $this->twig = $twig;
            $this->session = $session;
            $this->configuration = $configuration;
    }
	
	
	/**
	* generate
	*
	* This function call the urlgenerator
	*
	* @param        string   $name    name of the road
	* @param        array   $parameters    parameters for the url
	* @param        bool   $absolute   Whether the url should be absolute or no (not implemented yet)
	* @return 		string 	the url generated
	* @access       public
	* @author       Marine BENOIT
	*/
	public function generate($name, $parameters = array(), $absolute = false)
        {
		return $this->generator->generate($name,$parameters,$absolute);
	}
	
	
	/**
	* handle
	*
	* This function will be call every time the ask for a new page, it will handle every thing looking for the action, executing that action and then rendering the result
	*
	* @param        Request   $request    name of the road
	* @return 		Response  the response
	* @access       public
	* @author       Marine BENOIT
	*/
    public function handle(Request $request)
    {
        
        
        try {
                    $route = $this->matcher->getArg($request);
                    if($route['neededRole'] != 'NO_ROLE'){
				if($this->session->has('user') == false){
					if(!$this->session->has('refUrl')){
						$this->session->set('refUrl' ,$request->getUri());
					}
					header('Location: '.$this->generator->getUrl('login'));  
					exit(); 
				}
				else{
					$user = $this->session->getUser();
					if($user){
						if(!$user->hasRole($route['neededRole'])){
							if(!$this->session->has('refUrl')){
								$this->session->set('refUrl' ,$request->getUri());
							}
							header('Location: '.$this->generator->getUrl('login'));   
							exit(); 
						}
					}else{
						$this->session->getFlashBag()->add('login_error','noUser');
						header('Location: '.$this->generator->getUrl('login'));   
						exit(); 
					}
				}
			}
                        
                    $request->attributes->add($route);
                    $info = explode('::',$route['_controller']);
                    $controller = new $info[0]();
			//controle du droit d'admin
			
                    $controller->setTwig($this->twig);
                    $controller->seturlGenerator($this->generator);
                    $controller->setSession($this->session);
                    $controller->setConfiguration($this->configuration);
                    return new Response($controller->$info[1]($request,$route['arg']));
        } 
        catch (\Exception $e) {
            if($request->isXmlHttpRequest()){
                return new \Symfony\Component\HttpFoundation\JsonResponse(array('response' => false ,'error' => $e ));
            }
            $template = $this->twig->loadTemplate('Error.html.twig');
            return new Response($template->display(array('error' => $e )));
        }
    }
  
}