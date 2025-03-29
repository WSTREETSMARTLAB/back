<?php

namespace App\Core;

use Pimple\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    const PREFIX = "/api/v1";
    protected array $routes = [];
    protected array $middlewares = [];
    protected string $controllerNamespace = 'App\\Http\\Controllers\\';

    public function __construct(Container $container)
    {
        $this->middlewares = $container["middleware"];
        $this->routes = require __DIR__ . "/../../routes/api.php";
    }

    public function dispatch(Request $request)
    {
        $method = $request->getMethod();
        $path = $request->getPathInfo();

        foreach ($this->routes as $route) {
            [$routeMethod, $routePath, $handler] = $route;

            if ($method === $routeMethod && $path === self::PREFIX . $routePath) {
                [$controllerName, $methodName] = explode('@', $handler);

                $controllerClass = $this->controllerClass($controllerName);
                $controller = new $controllerClass();

                return new JsonResponse($controller->{$methodName}($request));
            }
        }

        return new Response('Not Found', Response::HTTP_NOT_FOUND);
    }

    private function controllerClass(string $controllerName): string
    {
        return $this->controllerNamespace . $controllerName;

//        return new $controllerClass();
    }
}
