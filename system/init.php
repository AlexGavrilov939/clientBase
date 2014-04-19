<?php
/**
 *  Initialize system file
 *
 * Created by Alex Gavrilov.
 */

namespace system;

$initConfigFile = dirname(__DIR__) . '/config.php';
var_dump($initConfigFile);

if(!file_exists($initConfigFile)) {
    die('unable to load config file!');
}

require_once $initConfigFile;
if (!defined('APP__ROOT')) {
    print "Error loading `APP_ROOT` from {$initConfigFile}!\n";
    exit(1);
}
if (!isset($GLOBALS['APP_ENV'])) {
    print "Error loading `APP_ENV` from {$initConfigFile}!\n";
    exit(1);
}
if (!isset($GLOBALS['PACKAGES_PATH']) || !is_array($GLOBALS['PACKAGES_PATH'])) {
    print "Error loading `PACKAGES_PATH` from {$initConfigFile}!\n";
    exit(1);
}