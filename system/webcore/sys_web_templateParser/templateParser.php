<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

/**
 * Class parser for to work with views
 * @package sys\web
 */
class templateParser
{
    /**
     *  Generate view content
     *
     * @param $template
     * @param array $data
     * @param bool $output
     * @return bool|string
     */
    public function generate($template, $data = [], $output = true)
    {
        $loadPath = $this->getLoadPath($template);
        if(!file_exists($loadPath)) {
            return false;
            //@TODO exception
        }
        ob_start();
        require_once $loadPath;
        if($output) {
            ob_get_flush();

            return true;
        } else {
            $content = ob_get_contents();
            ob_clean();

            return $content;
        }
    }

    /**
     *  Build view load path
     *
     * @param $template
     * @return string
     */
    private  function getLoadPath($template)
    {
        return WEB_PATH . '/views/' . $template . '.php';
    }
}