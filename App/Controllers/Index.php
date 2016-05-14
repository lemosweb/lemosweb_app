<?php

namespace App\Controllers;

use lemosweb\Controller\Action;
use \lemosweb\DI\Container;
use App\Models\Login;

class Index extends Action
{


	public function index()
	{        
            
            if (!empty($_SESSION['loginSession'])) {

                $this->render('admin');


            }else{

                $this->render('index');
                

            }
            
	}

    

    public function admin()
    {

        if (isset($_SESSION['loginSession'])) {
            
            $this->render('admin');

        }else{


            $login = new Login;

            
            $inputVars = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            
            if (empty($inputVars))  {
                
                $this->render('index');
                


            }else{


                    if ($login->check($inputVars['nome'], $inputVars['password'])) {
                        
                                                
                        $session = $login->getSession();

                        $this->view->session = $session;
                        $this->render('admin');
                        

                    }else{

                        $this->render('index');
                        
                    }

            }

        }                
    }

    public function logout()
    {
        $logout = new Login;
        $logout->logout();

        $this->render('index');

    }
        

        
}