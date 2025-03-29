<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRequest
{
    public function handle(Request $request, callable $next): Response
    {
        $response = $next($request);

        return $response;
    }
}
