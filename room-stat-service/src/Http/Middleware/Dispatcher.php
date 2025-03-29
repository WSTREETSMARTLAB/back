<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;

class Dispatcher
{
    public function __construct(private array $middleware)
    {
    }

    public function dispatch(Request $request)
    {
        $next = fn(Request $req) => $req;

        foreach (array_reverse($this->middleware) as $middlewareClass) {
            $middleware = new $middlewareClass();
            $prevNext = $next;
            $next = fn(Request $req) => $middleware->handle($req, $prevNext);
        }

        return $next($request);
    }
}
