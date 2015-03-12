<?php
namespace Arch\Controller;

use Arch\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller{
	
    public function loginAction(Request $request)
    {
 		return $this->render('Users/login.html.twig');
    }

}
