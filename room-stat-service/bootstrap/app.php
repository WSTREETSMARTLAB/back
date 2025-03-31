<?php

use Pimple\Container;

$container = new Container();

$container['config'] = [
    'db' => require __DIR__.'/../config/mysql.php',
    'middleware' => require __DIR__.'/../config/middleware.php',
    'session' => require __DIR__.'/../config/session.php',
];

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

$container['middleware'] = function ($c) {
    return $c['config']['middleware'];
};

if ($container['config']['session']['driver'] === 'redis') {
    $container['session'] = function ($c) {
        $cfg = $c['config']['session']['redis'];
        $client = new Redis();
        $client->connect($cfg['host'], $cfg['port']);
        $client->select($cfg['db'] ?? 0);

        if (!empty($cfg['password'])) {
            $client->auth($cfg['password']);
        }

        return $client;
    };
}

$container['router'] = function ($c) {
    return new \App\Core\Router($c);
};

return $container;
