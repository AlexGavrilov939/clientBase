<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\io;

class input
{
    private static $INTERNAL;

    /**
     * Construct new input object
     *
     * If global argv var exists we'll parse it
     */
    public function __construct()
    {
        if(isset($GLOBALS['argv'])) {
            $this->setArguments($this->importArgs($GLOBALS['argv']));
        }
    }

    /**
     * Export parsed data as array
     *
     * @return array
     */
    public function export()
    {
        return self::$INTERNAL;
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
//  [1] => "/opt/src/clientBase/name",
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

    /**
     * Set arguments to internal parsed data
     *
     * @param array $array
     * @param bool $clean Clear already exists data
     * @return bool
     */
    public function setArguments($array, $clean = true)
    {
        if($clean) {
            self::$INTERNAL = $array;
        } else {
            self::$INTERNAL = array_merge_recursive(self::$INTERNAL, $array);
        }
        return true;
    }


}