<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use ReflectionMethod;

class Router
{
    const CONTROLLER__DEFAULT = 'main';
    const CONTROLLER__NOT_FOUND_PAGE = 'page404';
    const METHOD__DEFAULT = 'index';

    private $controllerLocation;
    private $controllerExt;
    private $requestParams = [];
    private $controllersInstance = [];

    public function __construct()
    {
        $this->requestParams = $this->prepareParams();
        $this->controllerLocation = WEB_PATH . '/controllers/';
        $this->controllerExt = '.php';
    }

    public function prepareParams()
    {
       $requestData = explode('/', substr($_SERVER['REQUEST_URI'], 1));

       return [
         'controller' => $requestData[0] ? pathinfo($requestData[0], PATHINFO_FILENAME) : self::CONTROLLER__DEFAULT,
         'method'     => $requestData[1] ? pathinfo($requestData[1], PATHINFO_FILENAME) : self::METHOD__DEFAULT
       ];
    }

    private function loadController($controller)
    {
        $loadPath = $this->controllerLocation . $controller . $this->controllerExt;
        if(!file_exists($loadPath)) {
            echo 'prepare to load 404 page';
            $this->showPage404();
            return false;
        }
        return require_once $loadPath;
    }

    public function launch()
    {
        $controller = $this->requestParams['controller'];
        $method = $this->requestParams['method'];
        if($this->loadController($controller)) {
          $this->loadMethod($controller, $method);
        }
    }

    private function isClassMethodPublic($class, $method)
    {
        $reflection = new ReflectionMethod($class, $method);
        if ($reflection->isPublic()) {
            return true;
        }
        return false;
    }

    private function getControllerInstance($controller)
    {
        if(!isset($this->controllersInstance[$controller])) {
            $this->controllersInstance[$controller] = (new $controller);
        }
        return $this->controllersInstance[$controller];
    }

    protected function loadMethod($controller, $method)
    {
        $controllerInstance = $this->getControllerInstance($controller);
        if(method_exists($controllerInstance, $method)) {
            if($this->isClassMethodPublic($controllerInstance, $method)) {
                $controllerInstance->$method();
            }
        } else {
            $this->showPage404();
        }
    }

    private function showPage404()
    {
        $this->loadController(self::CONTROLLER__NOT_FOUND_PAGE);
        $this->loadMethod(self::CONTROLLER__NOT_FOUND_PAGE, self::METHOD__DEFAULT);
    }
}