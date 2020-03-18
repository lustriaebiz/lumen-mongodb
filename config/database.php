<?php
    return [
        'default' => 'mongodb',
        'connections' => [
            'mongodb' => [ 
                'driver' => 'mongodb',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', 27017),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'options' => [
                    'database' => 'admin' // sets the authentication database required by mongo 3
                ]
            ],
            'mysql1' => [ 
                'driver' => 'mysql',
                'host' => env('DB_HOST_MYSQL1', 'localhost'),
                'port' => env('DB_PORT_MYSQL1', 3306),
                'database' => env('DB_DATABASE_MYSQL1', 'lumen_app'),
                'username' => env('DB_USERNAME_MYSQL1', 'root'),
                'password' => env('DB_PASSWORD_MYSQL1'),
                'options' => [
                    'database' => 'admin' // sets the authentication database required by mongo 3
                ]
            ],
        ],
        'migrations' => 'migrations',
        'redis' => [
            // 'cluster' => true,
            'client' => 'predis',
            'default' => [
            //   'host' => env('REDIS_HOST', '127.0.0.1'),
            //   'password' => env('REDIS_PASSWORD', null),
            //   'port' => env('REDIS_PORT', 6379),
            //   'database' => env('REDIS_DATABASE', 1)
            ],
            // 'options' => [
            //     'cluster' => 'redis',
            //     'parameters' => ['
            //         password' => env('REDIS_PASSWORD', 'secret!@#')
            //     ],
            // ],
        ],
    ];