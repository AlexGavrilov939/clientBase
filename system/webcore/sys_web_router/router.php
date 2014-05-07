<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use ReflectionMethod;

class Router
{
    const DEFAULT__CONTROLLER = 'base';
    const DEFAULT__METHOD = 'index';

    protected $requestParams = [];

    public function __construct()
    {
        $this->requestParams = $this->prepareParams();
    }

    public function prepareParams()
    {
       $requestData = explode('/', substr($_SERVER['REQUEST_URI'], 1));
       return [
         'controller' => $requestData[0] ? pathinfo($requestData[0], PATHINFO_FILENAME) : self::DEFAULT__CONTROLLER,
         'method'     => $requestData[1] ? pathinfo($requestData[1], PATHINFO_FILENAME) : self::DEFAULT__METHOD
       ];
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
        $controller = $this->requestParams['controller'];
        $method = $this->requestParams['method'];
        $this->loadController($controller);
        $this->loadMethod($controller, $method);
       // (new $controller)->$method();
    }

    protected function loadMethod($controller, $method)
    {
        static $controllerInstance;
        if(!isset($controllerInstance))
        {
            $controllerInstance = (new $controller);
        }

        if (method_exists($controllerInstance, $method))
        {
            $reflection = new ReflectionMethod($controller, $method);
            if (!$reflection->isPublic()) {
                die($this->showPage404());
            }
            return $controllerInstance->$method();
        }
        $this->showPage404();
    }

    public function showPage404()
    {
        echo 'тут будет страница 404';
        return '';
    }


}