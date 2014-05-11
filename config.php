<?php
/**
 * General config file
 *
 * Created by Alex Gavrilov.
 */

const DEBUG = false;

const APP__ROOT = __DIR__;

// dev | prod
$GLOBALS['APP_ENV'] = 'dev';

$GLOBALS['PACKAGES_TYPE'] = 'src';

$GLOBALS['PACKAGES_PATH'] = [
    APP__ROOT . '/system/core',
    APP__ROOT . '/system/app',
    APP__ROOT . '/system/packages',
    APP__ROOT . '/system/webcore',
    WEB_PATH  . '/models'
];