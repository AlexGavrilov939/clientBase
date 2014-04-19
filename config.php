<?php
/**
 * General config file
 *
 * Created by Alex Gavrilov.
 */

const DEV__DEBUG = false;

const APP__ROOT = __DIR__;

// dev | prod
$GLOBALS['APP_ENV'] = 'dev';

$GLOBALS['PACKAGES_PATH'] = [
    APP__ROOT . '/pkg_russianPost',
];