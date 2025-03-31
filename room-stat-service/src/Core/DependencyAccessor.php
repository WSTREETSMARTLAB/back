<?php

namespace App\Core;

use Pimple\Container;
use Psr\Log\LoggerInterface;

class DependencyAccessor
{
    private static ?Container $container = null;

    public function __construct()
    {
        if (!self::$container) {
            self::$container = require __DIR__ . '/../../bootstrap/app.php';
        }
    }

    public function container(): Container
    {
        return self::$container;
    }

    public function db(): \PDO
    {
        return self::$container['db'];
    }

    public function logger(): LoggerInterface
    {
        return self::$container['logger'];
    }

    public function config(): array
    {
        return self::$container['config'];
    }

    public function router(): Router
    {
        return self::$container['router'];
    }

    public function session(): \Redis
    {
        return self::$container['session'];
    }
}
