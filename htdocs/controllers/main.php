<?php
use sys\web\controller;
use system\lib\cache;

/**
 * Created by Alex Gavrilov.
 */
class Main
    extends controller
{

    public function index()
    {
        $orders  = $this->model()->getOrdersList();
        $data['orders'] = $orders;
        echo '<pre>';
        print_r($orders);
        echo '</pre>';
        $data['content'] = $this->view()->generate('dashboard', $data['orders'], false);
        $this->view()->generate('template', $data);
    }

    public function logout()
    {
        header("Location: /login");
    }

    public function test()
    {
        $input = 'get document by id';

        $cache = cache::factory();
        $cacheKey = md5(json_encode($input));

        $timeStart = microtime("H:i:s");
        if(($result = $cache->get($cacheKey)) == false) {
            echo 'новая запись';
            $input = [];

            for($i = 0; $i < 100000; $i++) {
                $input[$i] = $i * 2;
            }

            $cache->set($cacheKey, $input);
        } else {
            echo 'запись из кэша';
        }
        $timeEnd = microtime("H:i:s");
        var_dump($timeEnd - $timeStart);
    }


}