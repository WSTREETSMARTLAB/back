<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;

class ValidateToken
{
    public function handle(Request $request, callable $next): Request
    {
        return $next($request);
    }
}
