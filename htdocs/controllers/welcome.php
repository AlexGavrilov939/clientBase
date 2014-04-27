<?php
use sys\web\controller;

/**
 * Created by Alex Gavrilov.
 */

class Welcome
    extends controller
{
    public function index()
    {
        $test['welcome'] = 'Добрый вечер!';
        $this->parser()->parse('welcome',$test);
    }
}