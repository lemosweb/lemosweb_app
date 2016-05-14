<?php


namespace App\Models;


use lemosweb\DB\ConnectDB;


class Login {

    private $db;
    private $loginUser = [];
    private $userLevel;

    

    public function check($user, $password)
    {

        $this->db = ConnectDB::getInstance();

        $query = "select * from users where user = :user and password = :password";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":password", sha1(md5($password)));

        $stmt->execute();


        if(!$stmt->rowCount()){

            return false;

        }


        $this->setLoginUser($stmt->fetchAll(\PDO::FETCH_ASSOC));


        return true;

    }

    public function getSession()
    {
        if($this->getLoginUser()):

            

                foreach($this->getLoginUser() as $user):

                    $_SESSION['loginSession']['user'] = $user['user'];
                    $_SESSION['loginSession']['name'] = $user['name'];
                    $_SESSION['loginSession']['level'] = $user['level'];
                    $this->setUserLevel($user['level']);

                endforeach;             
            


        endif;

        

    }


    public function getUserLevel()
    {
        return $this->userLevel;
    }

    private function setUserLevel($userLevel)
    {
        $this->userLevel = $userLevel;
    }

    public function getLoginUser()
    {
        return $this->loginUser;
    }


    private function setLoginUser($loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION);
        ob_end_flush();
        

    }


    
    
    
}
