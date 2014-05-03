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
}