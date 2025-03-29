<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;

class Authorize
{
    public function handle(Request $request, callable $next): Request
    {


        return $next($request);
    }
}
