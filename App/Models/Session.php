<?php

namespace App\Models;


class Session
{
    private $session;

 
    public function getSession($session = null)
    {

        if ($this->session == null) {

            if(!session_id()):
                
                ob_start();
                session_start();  
                
                

                $this->session = $_SESSION;

            endif;

            return $this->session;            

        }

    }
    
    function setSession($session) {
        $this->session = $session;
    }



   



}