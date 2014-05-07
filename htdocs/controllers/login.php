<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class Login
    extends controller
{

    public function index()
    {
        session_start();
        $_SESSION['test'] = 'testtttt';
        var_dump($_SESSION);
        $this->parser()->parse('loginPage');

    }

    public function signin()
    {
        if($this->checkAjaxRequest()) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if($this->mongoDB()->selectOne('users', ['login' => $login, 'password' => $password]) != null) {
               $this->initSession();
               echo true;
            } else {
                echo false;
            }

        } else {
            header('Location: /login');
        }
    }

    public function DBselect()
    {
        $collections = $this->mongoDB()->getCollectionNames(['users']);
        echo $this->parser()->loadView('DBselect', $collections);
    }
    private function initSession()
    {
        session_start();
        $_SESSION['in_auth'] = true;
    }

    private function mongoDB()
    {
        static $mongoClient;
        if(!isset($mongoClient)) {
            $mongoClient = \system\lib\mongoDB::factory();
        }
        return $mongoClient;
    }

    public function dbRemove()
    {
        if($this->checkAjaxRequest()) {
            $dbName = $_POST['name'];
            $this->mongoDB()->removeCollection($dbName);
        } else {
            $this->get404();
        }
    }

    public function dbCreate()
    {
        if($this->checkAjaxRequest()) {
            $dbName = $_POST['name'];
            $this->mongoDB()->createCollection($dbName);
        } else {
            $this->get404();
        }
    }

    public function saveDbName()
    {
        if($this->checkAjaxRequest()) {
            $dbName = $_POST['name'];
            setcookie("currentDbName", $dbName, time()+7200, "localhost");
        } else {
            $this->get404();
        }
    }


}