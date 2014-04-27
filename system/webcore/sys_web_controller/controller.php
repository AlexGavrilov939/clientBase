<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use sys\debug\log;

abstract class controller
{
    protected $test;

    public function __construct()
    {
        $this->test = 'Hello, i am base controller!';
    }

    public function writeLn()
    {
        return $this->test;
    }

    public function test()
    {
        log::put("test from: ", __METHOD__);
    }

    protected function parser()
    {
        static $parser;
        if(!isset($parser)) {
            $parser = new parser();
        }
        return $parser;
    }
}