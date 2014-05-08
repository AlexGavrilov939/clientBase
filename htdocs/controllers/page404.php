<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class page404
    extends controller
{
    public function index()
    {
        $this->parser()->parse('404page');
    }
}