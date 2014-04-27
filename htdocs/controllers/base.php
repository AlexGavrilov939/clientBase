<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\controller;

class base
    extends controller
{

    public function __construct()
    {
        //$this->index();
    }

    public static function index()
    {
        $test = 'test';
        echo 'fuck yeah!';
        //$this->parser()->parse('base', $test);

    }
}