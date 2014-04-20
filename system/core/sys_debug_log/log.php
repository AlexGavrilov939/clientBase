<?php
/**
 * Created by Alex Gavrilov
 */

namespace sys\debug;

class log
{
   public static function put($input)
   {
       $date = date("G:i:s");
       $output = "[{$date}]: {$input} \n";
       echo $output;
   }
}