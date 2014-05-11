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

    /**
     *  Initializes the configuration
     *
     * @return array
     */
    private static function prepareConfigs()
    {
        static $configs;
        if(!isset($configs)) {
            $configs = [
                'controllerLocation' => WEB_PATH . '/controllers/',
                'controllerExt' => '.php'
            ];
        }

        return $configs;
    }

    private static function prepareParams()
    {
       $requestData = explode('/', substr($_SERVER['REQUEST_URI'], 1));

       return [
         'controller' => $requestData[0] ? pathinfo($requestData[0], PATHINFO_FILENAME) : self::CONTROLLER__DEFAULT,
         'method'     => $requestData[1] ? pathinfo($requestData[1], PATHINFO_FILENAME) : self::METHOD__DEFAULT
       ];
    }

    /**
     *  Load controller or page 404
     *
     * @param $controller
     * @return bool|mixed
     */
    private static function loadController($controller)
    {
        $loadPath = self::prepareConfigs()['controllerLocation'] . $controller . self::prepareConfigs()['controllerExt'];
        if(!file_exists($loadPath)) {
            self::showPage404();
            return false;
        }

        return require_once $loadPath;
    }

    /**
     *  Load public controller method or page 404
     *
     * @param $controller
     * @param $method
     */
    private static function loadMethod($controller, $method)
    {
        $controllerInstance = self::getControllerInstance($controller);
        if(method_exists($controllerInstance, $method)) {
            if(self::isClassMethodPublic($controllerInstance, $method)) {
                $controllerInstance->$method();
            }
        } else {
            self::showPage404();
        }
    }

    /**
     *  Loads the appropriate controller or error page
     */
    public static function launch()
    {
        $params  = self::prepareParams();
        if(self::loadController($params['controller'])) {
          self::loadMethod($params['controller'], $params['method']);
        }
    }

    /**
     *  Check if a class method is public
     *
     * @param $class
     * @param $method
     * @return bool
     */
    private static function isClassMethodPublic($class, $method)
    {
        $reflection = new ReflectionMethod($class, $method);
        if ($reflection->isPublic()) {
            return true;
        }
        return false;
    }

    /**
     *  Get the controller instance
     *
     * @param $controller
     * @return mixed
     */
    private static function getControllerInstance($controller)
    {
        static $controllerInstance;
        if(!isset($controllerInstance[$controller])) {
            $controllerInstance[$controller] = (new $controller);
        }

        return $controllerInstance[$controller];
    }

    /**
     *  Loads the controller output error page
     */
    private static function showPage404()
    {
        self::loadController(self::CONTROLLER__NOT_FOUND_PAGE);
        self::loadMethod(self::CONTROLLER__NOT_FOUND_PAGE, self::METHOD__DEFAULT);
    }
}