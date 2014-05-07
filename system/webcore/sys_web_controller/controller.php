<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use sys\pkg\config;

abstract class controller
{
    protected $baseClass;


    public function __construct()
    {
        if(!$this->loggedIn() && $_SERVER['REQUEST_URI'] != '/login' && $_SERVER['REQUEST_URI'] != '/login/signin') {
            header('Location: /login');
        }
    }

    protected  function loggedIn()
    {
        if($_COOKIE['PHPSESSID']) {
            return true;
        }
        return false;
    }

    protected function parser()
    {
        $this->baseClass = get_called_class();
        static $parser;
        if(!isset($parser)) {
            $parser = new parser();
        }
        return $parser;
    }

    protected function loadView($view)
    {
       return $this->parser()->loadView($view);

    }

    public function getConfig()
    {
        static $config;
        if (!isset($config)) {
            $config = config::getPackageConfig($this->baseClass);
        }
        return $config;

    }

    protected function get404()
    {
        $this->parser()->parse('404');
    }

    protected function checkAjaxRequest()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }
}