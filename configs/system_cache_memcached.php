<?php

\sys\pkg\config::$package['system_cache_memcached'] = [
    'remote' => [

    ],
    'local' => [
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => 11211
            ]
        ]
    ]
];

\sys\pkg\config::$package['system_cache_memcached']['default'] =& \sys\pkg\config::$package['system_cache_memcached']['local'];