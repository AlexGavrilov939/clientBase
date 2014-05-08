<?php
/**
 * Created by Alex Gavrilov.
 */

$APP_PATH = dirname(__DIR__);

const WEB_PATH = __DIR__;
const ENV = 'web';
//const DEBUG = false;

header('Content-Type: text/html; charset=UTF-8');

require_once $APP_PATH . '/system/init.php';
(new \sys\web\router())->launch();