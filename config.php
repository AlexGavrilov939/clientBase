<?php
/**
 * General config file
 *
 * Created by Alex Gavrilov.
 */

const DEBUG = true  ;

const APP__ROOT = __DIR__;

// dev | prod
$GLOBALS['APP_ENV'] = 'dev';

$GLOBALS['PACKAGES_TYPE'] = 'src';

$GLOBALS['PACKAGES_PATH'] = [
    APP__ROOT . '/system',
];