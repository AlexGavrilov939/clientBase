<?php
/**
 * Created by Alex Gavrilov
 */

namespace sys\debug;

class log
{
   public static function put($input, $method = false)
   {
       $date = date("G:i:s");
       $output = "[{$date}]: {$input} \n";

       if($method) {
           $output .= "[{$method}]";
       }
       echo $output;
   }
}