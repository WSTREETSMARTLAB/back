<?php

use Pimple\Container;

$config = require __DIR__ . '/../config/app.php';

$container = new Container();
$container['config'] = $config;
