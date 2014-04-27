<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\loader;

use sys\debug\log;

class fileLoader {

    public static function load($file)
    {
        $filepath = self::search($file);
        if($filepath == null) {
            throw new \Exception("Unable to load file {$file} in {$filepath}!");
        }
        DEBUG && log::put("Loading: {$filepath}");
        return require_once $filepath;
    }

    public static function search($file)
    {
        DEBUG && log::put("Searching file: {$file}");
        return file_exists($file) ? $file : null;
    }
}