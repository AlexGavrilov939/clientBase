<?php
/**
 * Created by Alex Gavrilov
 */

namespace sys\pkg;

abstract class config
{
    public static $configSection;
    public static $package;

    public static function getPackageConfig($class)
    {
        $configPath = self::setConfigSection() . self::getConfigFile($class);
        if(file_exists($configPath)){
            echo "вот содержимое файла:";
            $config = self::init($configPath);
            var_dump($config);

        } else {
            echo "ищем тут $configPath\n";
            echo 'конфиг файла НЕТ!!!читай доки еп!';
        }
    }

    private static function init($packagePath)
    {
        return include $packagePath;
    }


    private static function setConfigSection()
    {
        return self::$configSection = APP__ROOT . '/configs/';
    }

    private static function getConfigFile($class)
    {
        return $class . '.php';
    }
}