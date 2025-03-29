<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    public function handle(Request $request, callable $next): Response
    {
        $response = $next($request);

        return $response;
    }
}
