<?php
/**
 * Created by Alex Gavrilov.
 */

\sys\pkg\config::$package['system_lib_cache'] = [
    'memcached_local' => [
        'driver' => 'system_cache_memcached',
        'config_section' => 'local'
    ]
];

\sys\pkg\config::$package['system_lib_cache']['default'] =& \sys\pkg\config::$package['system_lib_cache']['memcached_local'];
