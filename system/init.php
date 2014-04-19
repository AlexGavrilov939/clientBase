<?php
/**
 *  Initialize system file
 *
 * Created by Alex Gavrilov.
 */

namespace system\core;

$initConfigFile = dirname(__DIR__) . '/config.php';

if(!file_exists($initConfigFile)) {
    die('unable to load config file!');
}

require_once $initConfigFile;

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

spl_autoload_register(function ($packageName) {
    if (strpos($packageName, '\\') === 0) {
        $packageName = mb_substr($packageName, 1);
    }

    $packageName = str_replace("\\", "_", $packageName);


    switch (strtolower($GLOBALS['PACKAGES_TYPE'])) {
        case "src":
        default:
            $packagePath = APP__ROOT;
            foreach ($GLOBALS['PACKAGES_PATH'] as $dev_packages_path) {
                $packagePath = $dev_packages_path . "/" . $packageName;
                $manifestFile = "{$packagePath}/manifest.json";
                if(class_exists('\mpr\debug\log', false)) {
                    DEBUG && \core\log::put("Searching {$manifestFile}", "init");
                }
                if (file_exists($manifestFile)) {
                    $initFile = json_decode(file_get_contents($manifestFile), 1)['package']['init'];
                    $packagePath .= "/{$initFile}";
                    break;
                }
            }
            $packagePath =  __DIR__ .'/' . $packageName .'/' . substr($packageName, strrpos($packageName, '_') + 1) . '.php';
    }


    echo $packagePath;
    if (file_exists($packagePath)) {
        require_once $packagePath;
    } else {
        print_r("ERROR LOADING {$packageName}" .     "init");
    }
});


