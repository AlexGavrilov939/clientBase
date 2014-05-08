<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use sys\pkg\config;

abstract class controller
{
    protected $baseClass;

    abstract function index();

    public function __construct()
    {
        header('Content-Type: text/html; charset=utf-8');
//        if(!$this->loggedIn() && $_SERVER['REQUEST_URI'] != '/login' && $_SERVER['REQUEST_URI'] != '/login/signin') {
//            header('Location: /login');
//        }
    }

    protected  function loggedIn()
    {
        if($_COOKIE['PHPSESSID']) {
            return true;
        }
        return false;
    }

    /**
     *  Function return templateParser instance
     *
     * @return templateParser
     */
    protected function view()
    {
        $this->baseClass = get_called_class();
        static $templateParser;
        if(!isset($parser)) {
            $templateParser = new templateParser();
        }

        return $templateParser;
    }

    public function getConfig()
    {
        static $config;
        if (!isset($config)) {
            $config = config::getPackageConfig($this->baseClass);
        }

        return $config;

    }

    /**
     *  Displays the page 404
     */
    protected function get404page()
    {
        $this->view()->generate('404page');
    }

    /**
     *  Checks if request is Ajax and if not then displays page 404
     *
     * @return bool
     */
    protected function isAjaxRequest()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            return true;
        }
        $this->get404page();

        return false;
    }
}