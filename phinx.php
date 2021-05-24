<?php

use Dotenv\Dotenv;

require_once 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'paths' => [
        'migrations' => __DIR__.'/App/Db/Migrations',
        'seeds' => __DIR__.'/App/Db/Seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations_log',
        'default_database' => 'development',
        'development' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => 3306,
            'charset' => getenv('CHARSET')
        ]
    ],
    'version_order' => 'creation'
];
