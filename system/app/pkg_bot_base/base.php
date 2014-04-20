<?php
/**
 * Created by Alex Gavrilov
 */

namespace pkg\bot;

abstract class base
{
    public function run()
    {
        $this->prepare();
        $this->main();
    }

    abstract public function prepare();

    abstract public function main();
}