<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\controller;

class Login
    extends controller
{
    /**
     *  Main controller function
     */
    public function index()
    {
        $this->view()->generate('loginPage');
    }

    public function signIn()
    {
       if($this->isAjaxRequest()) {
           $login = self::clearInputData($_POST['login']);
           $password = self::clearInputData($_POST['password']);
           if($this->model()->checkAccountData($login, $password)) {
               $hash = self::generateUserHash($login, $password);
               $this->updateUserAccount($login, $hash);
               if($this->model()->checkUserSessionByHash($_SESSION['userId'])){
                   echo 'все ок';
               }
               echo 'все плохо';
               session_start();
               $_SESSION['userId'] = $hash;
           }
       }
    }

    private static function generateUserHash($login, $password)
    {
        return md5($login. $password . microtime());
    }

    private function updateUserAccount($login, $hash)
    {
        $this->model()->updateUserAccount($login, $hash);
    }

}