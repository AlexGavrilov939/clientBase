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

    private $trackNumberTest = 12513072120811;
    private $trackNumber = 12513072083796;

    public function prepare()
    {
        log::put("prepare process");
    }

    public function main()
    {
        log::put("initialize curl");
        $curl = new curl();
        $curl->reset();
        $curl->addOptions([
            CURLOPT_VERBOSE => false,
        ]);
        $curl->prepare(self::HOST . $this->trackNumber);
        log::put("prepare to make execute");
        $content = $curl->execute();
        //$content = mb_convert_encoding($content, "UTF-16");
        //print_r($content);
        $regex = <<<EX
/class="b-departure">[\s\S]+<div\sclass="b-status__lu-date"[^>]+>[\s\S]+:\s(?<last__check_date>[\s\S]+)<\/div>[\s\S]+<div\sclass="b-status__lu-time"[^>]+>(?<last__check_time>[^<]+)<\/div>[\s\S]+<span>(?<track__number>[^\n]+)\n[\s\S]+class="b-dinfo">[\s\S]+<h2>(?<pkg__type>[\s\S]+)<\/h2>\n(?<pkg__info>[\s\S]+)\n\s+<\/div>[\s\S]+data-content="(?<from__address>[\s\S]+)">(?<from__index>\d+)<\/span>[\s\S]+class="b-status__move-to-map\smap-move-to"[^>]+>(?<to__index>[^<]+)<\/span><\/h2>\n(?<to__address>[\s\S]+)<div class="b-dinfo__weight">[\s\S]+<span>(?<pkg__weight>[^<]+)<\/span>[\s\S]+class="b-status__header">[\s\S]+<\/span>(?<pkg__status>[^<]+)<\/h1>/Uui
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
        return trim(preg_replace('/\s{2,}/', ' ', strip_tags($content)));
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