<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/20/14
 * Time: 2:25 AM
 */

use pkg\bot\base;
use system\net\socketServer;


class client
    extends base
{
    private $host = '127.0.0.1';
    private $post = '8080';

    public function prepare()
    {
    }

    public function main()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $connect = socket_connect($socket, $this->host, $this->post);
        $awr = socket_read($socket, 1024);
        echo 'Сервер сказал: ';
        $awr = socket_read($socket, 1024);
        echo $awr."<br />";

        $msg = "Hello Сервер!";
        echo "Говорим серверу \"".$msg."\"...";
        socket_write($socket, $msg, strlen($msg));
        echo 'OK <br />';

        echo "Сервер сказал: ";
        $awr = socket_read($socket, 1024);
        echo $awr."<br />";

        $msg = "exit";
        echo "Говорим серверу \"".$msg."\"...";
        socket_write($socket, $msg, strlen($msg));
        echo 'OK <br />';

    }
}