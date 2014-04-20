<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\debug\log;


require_once __DIR__ . '/init.php';

$arguments = (new \sys\io\input())->export();
$app_path = isset($arguments[0]) ? $arguments[0] : '';

if (!empty($app_path)) {
    log::put("app path is {$app_path}");
    sys\loader\fileLoader::load($app_path);
    log::put("fileloader load : {$app_path}", __METHOD__);
    $classname = basename($app_path, '.php');
    log::put("classname is : {$classname}", __METHOD__);
    if (!class_exists($classname, false)) {
        log::put("File {$app_path} does not contains class {$classname}!");
        return false;
    }
    $app = new $classname();
    $app->run();
}