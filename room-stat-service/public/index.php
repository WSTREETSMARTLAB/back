<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = require __DIR__ . '/../bootstrap/app.php';

$request = Request::createFromGlobals();
$router = $app['router'];
$response = $router->dispatch($request);
$response->send();
