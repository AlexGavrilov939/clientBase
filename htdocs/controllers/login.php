<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\controller;

class Login
    extends controller
{
    /**
     *  Main controller function
     */
    public function index()
    {
        $this->view()->generate('loginPage');
    }

    public function checkAuth()
    {
        echo 'test';
    }

}