<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => '172.16.0.30',
        'port'           => '1521',
        'database'       => 'NMMC',
        'service_name'   => 'ORCL',
        'username'       => 'AM.SOLIEV',
        'password'       => 'zzzz1111*',
        // 'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        // 'prefix'         => env('DB_PREFIX', ''),
        // 'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        // 'edition'        => env('DB_EDITION', 'ora$base'),
        // 'server_version' => env('DB_SERVER_VERSION', '12c'),
        // 'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],
];
