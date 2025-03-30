<?php

namespace App\Core;

use App\Http\Middleware\Dispatcher;
use Pimple\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    const PREFIX = "/api/v1";
    protected array $routes = [];
    protected array $middlewareClasses = [];
    protected string $namespace = 'App\\Http\\Transmitters\\';

    public function __construct(Container $container)
    {
        $this->middlewareClasses = $container["middleware"];
        $this->routes = require __DIR__ . "/../../routes/api.php";
    }

    public function dispatch(Request $request)
    {
        $method = $request->getMethod();
        $path = $request->getPathInfo();

        foreach ($this->routes as $route) {
            [$routeMethod, $routePath, $handler] = $route;

            if ($method === $routeMethod && $path === self::PREFIX . $routePath) {
                [$class, $method] = explode('@', $handler);

                $middlewareDispatcher = new Dispatcher($this->middlewareClasses);
                $processedRequest = $middlewareDispatcher->dispatch($request);

                $class = $this->transmitterClass($class);
                $transmitter = fn($req) => ((new $class())->{$method}($req));
                $response = $transmitter($processedRequest);

                return $response instanceof Response
                    ? $response
                    : new JsonResponse([
                        'data' => $response,
                    ]);
            }
        }

        return new Response('Not Found', Response::HTTP_NOT_FOUND);
    }

    private function transmitterClass(string $name): string
    {
        return $this->namespace . $name;
    }
}
