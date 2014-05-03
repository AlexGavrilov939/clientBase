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
        $loadPath = $this->getLoadPath($template);
        if(!file_exists($loadPath)) {
            log::put("template {$template} not found!");
        }

        require_once $loadPath;

    }


    public function loadView($template)
    {
        $loadPath = $this->getLoadPath($template);
        return file_get_contents($loadPath);
    }

    protected function getLoadPath($template)
    {
        return WEB_PATH . '/views/' . $template . '.php';
    }



}