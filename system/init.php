<?php
/**
 *  Initialize system file
 *
 * Created by Alex Gavrilov.
 */

namespace system\core;

use sys\debug\log;


$initConfigFile = dirname(__DIR__) . '/config.php';
$initLogFile = __DIR__ . '/core/sys_debug_log/log.php';

if(!file_exists($initConfigFile)) {
    die('unable to load config file!');
}
require_once $initConfigFile;

if(!file_exists($initLogFile)) {
    print 'log class not found!';
}
require_once  $initLogFile;

if (!defined('APP__ROOT')) {
    print "[ERROR] loading `APP_ROOT` from {$initConfigFile}!\n";
    exit(1);
}
if (!isset($GLOBALS['APP_ENV'])) {
    print "[ERROR] loading `APP_ENV` from {$initConfigFile}!\n";
    exit(1);
}
if (!isset($GLOBALS['PACKAGES_PATH']) || !is_array($GLOBALS['PACKAGES_PATH'])) {
    print "[ERROR] loading `PACKAGES_PATH` from {$initConfigFile}!\n";
    exit(1);
}

spl_autoload_register(function ($package_name) {
    //sys\web\Router
    DEBUG && log::put("start package name is {$package_name}");
    if (strpos($package_name, '\\') === 0) {
        $package_name = mb_substr($package_name, 1);
    }

    $package_name = str_replace("\\", "_", $package_name);


    static $server_uniq;
    if (!isset($server_uniq)) {
        $server_uniq = crc32(__DIR__);
    }

    switch (strtolower($GLOBALS['PACKAGES_TYPE'])) {
        case "phar":
            $packageArray = explode("_", $package_name);
            array_pop($packageArray);
            $packagePath = APP__ROOT . "/" . implode("/", $packageArray) . "/{$package_name}.phar";
            break;
        case "src":
        default:
            $packagePath = APP__ROOT;
            foreach ($GLOBALS['PACKAGES_PATH'] as $dev_packages_path) {
                DEBUG && log::put( "dev package path is: {$dev_packages_path}");
                DEBUG && log::put( "package name is {$package_name}\n");
                $packagePath = $dev_packages_path . "/" . $package_name;
                DEBUG && log::put( "package path is {$packagePath}\n\n");
                $manifest_file = "{$packagePath}/manifest.json";
                if(class_exists('\mpr\debug\log', false)) {
                    DEBUG && \sys\debug\log::put("Searching {$manifest_file}", "init");
                }
                if (file_exists($manifest_file)) {
                    $initFile = json_decode(file_get_contents($manifest_file), 1)['package']['init'];
                    $packagePath .= "/{$initFile}";
                    break;
                }
            }
    }
    if (file_exists($packagePath)) {
        require_once $packagePath;
    } else {
        log::put("ERROR LOADING {$package_name}", "init");
    }
});
require_once '/opt/src/clientBase/system/packages/system_lib_curl/curl.php';


