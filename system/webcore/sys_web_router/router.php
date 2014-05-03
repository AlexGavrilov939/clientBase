<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;


class Router
{
    const DEFAULT__CONTROLLER = 'base';
    const DEFAULT__METHOD = 'index';

    protected $request;

    public function __construct()
    {
        $this->request = $this->prepareParams();
    }

    public function prepareParams()
    {

       $requestUri = substr($_SERVER['REQUEST_URI'], 1);
       return explode('/', $requestUri);
    }

    protected function loadController($controller)
    {
        $loadPath = WEB_PATH . '/controllers/' . $controller . '.php';
        if(!file_exists($loadPath)) {
            exit($this->showPage404());
        }
        require_once $loadPath;
    }

    public function launch()
    {
        $data = $this->request;
        $controller = $data[0] ? pathinfo($data[0], PATHINFO_FILENAME) : self::DEFAULT__CONTROLLER;
        $method = $data[1] ? pathinfo($data[1], PATHINFO_FILENAME) : self::DEFAULT__METHOD;
        $this->loadController($controller);
        (new $controller)->$method();
    }

    public function showPage404()
    {
        echo 'тут будет страница 404';
        return '';
    }


}