<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use sys\debug\log;

class parser
{
    public function parse($template, $data = false)
    {
        $templatePath = WEB_PATH . '/views/';
        $loadPath = $templatePath . $template . '.php';
        if(!file_exists($loadPath)) {
            log::put("template {$template} not found!");
        }

        require_once $loadPath;
    }


}