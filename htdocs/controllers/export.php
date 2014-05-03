<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class export
    extends controller
{
    public function index()
    {
        $data['content'] = $this->parser()->loadView('export');
        $this->parser()->parse('template', $data);
    }

}