<?php
use sys\pkg\config;
use sys\web\controller;

/**
 * Created by Alex Gavrilov.
 */
class Welcome
    extends controller
{
    public function index()
    {
        require_once '/opt/src/clientBase/system/packages/system_lib_mongoDB/mongoDB.php';
        $client = \system\lib\mongoDb::factory();
        $test['mongo'] = $client->select('test');
        $test['welcome'] = 'Добрый вечер!';
        $this->parser()->parse('welcome',$test);
    }


}