<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\controller;

class Login
    extends controller
{
    public function index()
    {
        $content = $this->view()->generate('loginPage', [], false);
    }
}