<?php


namespace App;

use lemosweb\Init\Bootstrap;
use App\Models\Session;


class Init extends Bootstrap{

	
       
    protected function initRoutes()
    {
    	
       $route['home']  = array('route' => '/', 'controller' => 'index', 'action' => 'index');

       $route['logout']  = array('route' => '/logout', 'controller' => 'index', 'action' => 'logout');

       $route['admin']  = array('route' => '/admin', 'controller' => 'index', 'action' => 'admin');

       $session = new Session;
       $session->getSession();
       
       
       $this->setRoutes($route);             
       
       
    }
   
        
    
}
