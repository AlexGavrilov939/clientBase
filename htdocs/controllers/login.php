<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\controller;

class Login
    extends controller
{

    public function __construct()
    {
        parent::__construct();
        setcookie('userId', '', time() - 3600);
        setcookie('defaultDb', '', time() - 3600);
    }

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
               session_start();

               $hash = self::generateUserHash($login, $password);
               setcookie("userId", $hash, time() + 10800, '/');

               $this->updateUserAccount($login, $hash);
               echo 'ok';
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

    public function dbSelect()
    {
        if($this->isAjaxRequest()) {
            $data = $this->model()->getClientBases();
            $this->view()->generate('DBselect', $data);
        }
    }

    public function saveDefaultDb()
    {
        if($this->isAjaxRequest()) {
            if(!isset($_POST['defaultDb'])) {
                die();
            }
            setcookie('defaultDb', $_POST['defaultDb'], time() + 10800, '/');
        }
    }

    public function createDb()
    {
        if($this->isAjaxRequest()) {
            $this->model()->createCollection($_POST['name']);
        }
    }

    public function removeDb()
    {
        if($this->isAjaxRequest()) {
            $this->model()->removeCollection($_POST['name']);
        }
    }


}