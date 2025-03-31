<?php

namespace App\Http\Middleware;

class Dispatcher
{
    public function __construct(private array $middleware)
    {
    }

    public function dispatch(mixed $request)
    {
        $next = fn(mixed $req) => $req;

        foreach (array_reverse($this->middleware) as $middlewareClass) {
            $middleware = new $middlewareClass();
            $prevNext = $next;
            $next = fn(mixed $req) => $middleware->handle($req, $prevNext);
        }

        return $next($request);
    }
}
