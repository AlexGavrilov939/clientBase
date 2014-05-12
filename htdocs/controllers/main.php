<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class Main
    extends controller
{

    public function index()
    {
        $data['test'] = 'test';
        $data['content'] = $this->view()->generate('dashboard', $data['orders'], false);
        $this->view()->generate('template', $data);
    }

    public function logout()
    {
        header("Location: /login");
    }


}