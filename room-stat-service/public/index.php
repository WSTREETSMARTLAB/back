<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use App\Core\Router;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$router = new Router();
$response = $router->dispatch($request);
$response->send();
