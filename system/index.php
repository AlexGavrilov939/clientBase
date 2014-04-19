<?php
/**
 * Created by Alex Gavrilov.
 */

print_r('index process start' . "\n");
require_once __DIR__ . '/init.php';

print_r('prepare to get console arguments'. "\n");
$arguments = (new \core\input())->export();
$app_path = isset($arguments[0]) ? $arguments[0] : '';
print_r("app is already get!\n");

print_r("check if appPath is empty" . "\n");
if (!empty($app_path)) {
    \core\fileLoader::load($app_path);
}