<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\DependencyAccessor;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$router = (new DependencyAccessor())->router();
$response = $router->dispatch($request);
$response->send();
