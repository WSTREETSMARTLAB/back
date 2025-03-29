<?php

namespace App\Core;

use Pimple\Container;
use Psr\Log\LoggerInterface;

class DependencyAccessor
{
    private Container $container;

    public function __construct()
    {
        $this->container = require __DIR__ . '/../../bootstrap/app.php';
    }

    public function container(): Container
    {
        return $this->container;
    }

    public function db(): \PDO
    {
        return $this->container['db'];
    }

    public function logger(): LoggerInterface
    {
        return $this->container['logger'];
    }

    public function config(): array
    {
        return $this->container['config'];
    }

    public function router(): Router
    {
        return $this->container['router'];
    }
}
