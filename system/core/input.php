<?php
/**
 * Created by Alex Gavrilov.
 */

namespace system\io;

class Input
{

    /**
     * Construct new input object
     *
     * If global argv var exists we'll parse it
     */
    public function __construct()
    {
        if(isset($GLOBALS['argv'])) {
            var_dump($GLOBALS['argv']);
            $this->setArguments($this->importArgs($GLOBALS['argv']));
        }
    }

    /**
     * Function to parse php arguments
     *
     * @param array $argv
     * @return array
     */

// argv:
//[
//  [0] => "/opt/src/clientBase/system/index.php",
//  [1] => "/opt/src/clientBase/",
//]

    public function importArgs($argv){
        array_shift($argv);
        $out = array();
        foreach ($argv as $arg){
            //"/opt/src/clientBase/"
            if (substr($arg,0,2) == '--'){
                //--config_id=default  - example string
                $eqPos = strpos($arg,'=');
                if ($eqPos === false){
                    $key = substr($arg,2);
                    $out[$key] = isset($out[$key]) ? $out[$key] : true;
                } else {
                    $key = substr($arg,2,$eqPos-2);
                    $out[$key] = substr($arg,$eqPos+1);
                }
            } elseif (substr($arg,0,1) == '-'){
                if (substr($arg,2,1) == '='){
                    $key = substr($arg,1,1);
                    $out[$key] = substr($arg,3);
                } else {
                    $chars = str_split(substr($arg,1));
                    foreach ($chars as $char){
                        $key = $char;
                        $out[$key] = isset($out[$key]) ? $out[$key] : true;
                    }
                }
            } elseif (substr($arg,0,1) == ']'){
                list($key, $value) = explode('=', $arg);
                $out[$key] = $value;
            } else {
                $out[] = $arg;
            }
        }
        return $out;
    }


}