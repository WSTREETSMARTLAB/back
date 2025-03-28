<?php

use Pimple\Container;

$config = require __DIR__ . '/../config/app.php';

$container = new Container();

$container['config'] = $config;
$container['logger'] = function () {
    return new Monolog\Logger('room-stat-service');
};

$container['db'] = function ($c) {
    $config = $c['config']['db'];
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container['router'] = function () {
    return new \App\Core\Router();
};

return $container;
