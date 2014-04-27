<?php
/**
 * Created by Alex Gavrilov
 */

namespace sys\pkg;

use sys\loader\fileLoader;

abstract class config
{

    public static $package = [];

    public static function getPackageConfig($class)
    {
        $configSection = self::getPackageName($class);
        fileLoader::load(self::getConfigPath($configSection));
        return self::$package[$configSection];
    }

    public static function getPackageName($class)
    {
        if(mb_strpos($class, '\\') === 0) {
            $class = mb_substr($class, 1);
        }
        return str_replace('\\', '_', $class);
    }

    protected static function init($config)
    {
        var_dump("init!");
        if(self::searchConfig($config)) {
            $configPath =self::getPackageConfig($config);
            var_dump($configPath);
            require_once $configPath;
            echo 'true';
        }
        echo 'false';
    }

    protected static function searchConfig($config)
    {
        if(file_exists(self::getPackageConfig($config))) {
            return true;
        }
        return false;
    }

    protected static function getConfigPath($config)
    {
        return APP__ROOT . '/configs/' . $config . '.php';
    }
}