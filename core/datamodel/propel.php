<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'loneworker' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=loneworker',
                    'user'       => 'loneworker',
                    'password'   => 'loneworker',
                    'attributes' => [],
                    'settings'   => [
                        'charset' => 'utf8mb4',
                        'queries' => [
                            'utf8' => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci, COLLATION_CONNECTION = utf8mb4_unicode_ci, COLLATION_DATABASE = utf8mb4_unicode_ci, COLLATION_SERVER = utf8mb4_unicode_ci'
                        ]
                    ]
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'loneworker',
            'connections' => ['loneworker']
        ],
        'generator' => [
            'defaultConnection' => 'loneworker',
            'connections' => ['loneworker']
        ]
    ]
];