<?php


namespace App;

use lemosweb\Init\Bootstrap;
use lemosweb\autsession\Session;


class Init extends Bootstrap{

	
       
    protected function initRoutes()
    {

       $route['home']  = array('route' => '/', 'controller' => 'index', 'action' => 'index');

       $route['logout']  = array('route' => '/logout', 'controller' => 'index', 'action' => 'logout');

       $route['admin']  = array('route' => '/admin', 'controller' => 'index', 'action' => 'admin');

       $route['artigos'] = array('route' => '/artigos', 'controller' => 'artigos', 'action' => 'index');
       
       $route['cadastrar']  = array('route' => '/artigos/cadastrar', 'controller' => 'artigos', 'action' => 'cadastrar');



       $route['atualizaartigos'] = array('route' => '/artigos/atualiza', 'controller' => 'artigos', 'action' => 'atualiza');


       $session = new Session;
       $session->getSession();
       
       
       $this->setRoutes($route);             
       
       
    }
   
        
    
}
