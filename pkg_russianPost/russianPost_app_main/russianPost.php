<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/20/14
 * Time: 2:25 AM
 */

use pkg\bot\base;
use sys\debug\log;
use system\lib\curl;


class russianPost
    extends base
{
    const HOST  = 'https://gdetoedet.ru/track/';

    private $trackNumber = 12513072125878;

    public function prepare()
    {
        log::put("prepare process");
    }

    public function main()
    {
        log::put("initialize curl");
        $curl = new curl();
        $curl->reset();
        $curl->prepare(self::HOST . $this->trackNumber);
        log::put("prepare to make execute");
        $content = $curl->execute();
        $regex = <<<EX
/class="b-d_track-name">[\s\S]+<span>(?<track_number>\d+)\s+<\/div>[\s\S]+class="b-dinfo__type-parcel[\s\S]+<h2>(?<pkg_type>.*?)<\/h2>(?<pkg_class>[\s\S]+)<\/div>[\s\S]+class="b-status[\s\S]+data-content="(?<start_address>[\s\S]+)">(?<start_index>\d+)</ui
EX;
        preg_match($regex, $content, $matches);
        $data = [];
        foreach($matches as $key => $value) {
            if(is_numeric($key)) {
                continue;
            }
            $data[$key] = $this->clearContent($value);
        }

        print_r($data);
    }

    private function clearContent($content)
    {
        return trim(strip_tags($content));
    }

    private function getCurl()
    {
        static $curl;
        if(!isset($curl)) {
            $curl = new curl();
        }
        return $curl;
    }

    private function getTrackInfo()
    {
        $currentUrl = $this->buildUrl();
        log::put("current url is {$currentUrl}");
        $content = $this->loadUrl($currentUrl);
        print_r($content);
    }

    private function loadUrl($url)
    {
        $curl = $this->getCurl();
        $curl->reset();
        $data = $curl->execute($url);
        return $data;
    }

    private function buildUrl()
    {
        return self::HOST . $this->trackNumber;
    }


}