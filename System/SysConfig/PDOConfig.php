<?php

require_once 'App/Config/config.php';
global $db;
$config = [];
$config['dbname'] = DB_NAME;
$config['host'] = DB_HOST;
$config['dbuser'] = DB_USER;
$config['dbpass'] = DB_PASS;
$config['dboptions'] = DB_OPTIONS;
error_reporting(E_ALL);
try {
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'] . ";charset=utf8", $config['dbuser'], $config['dbpass'], $config['dboptions']);
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
