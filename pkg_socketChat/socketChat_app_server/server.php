<?php

use pkg\bot\base;
use sys\debug\log;

class server
    extends base
{

    private $host;
    private $port;

    public function prepare()
    {
        $this->host = '127.0.0.1';
        $this->post = 8080;
    }

    public function main()
    {
        $sock = socket_create(AF_INET, SOCK_STREAM, 0);
        //bind the socket
        socket_bind($sock, $this->host, $this->port) or die('Could not bind to address');
        socket_listen($sock);
        while (true) {
            log::put("listen connections", __METHOD__);
            /* Accept incoming  requests and handle them as child processes */
            $client =  socket_accept($sock);
            // Read the input  from the client – 1024000 bytes
           // $input =  socket_read($client, 1024000);
            // Strip all white  spaces from input
            //$output =  "input: {$input}";
            //$message = explode('=',$output);
            //$response = 'response';
            // Display output  back to client
            //socket_write($client, $response);
            //socket_close($client);
        }
// Close the master sockets
        socket_close($sock);
    }


}