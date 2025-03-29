<?php

namespace App\Http\Middleware;

use App\Repositories\ToolRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authorize
{
    public function handle(Request $request, callable $next): Request
    {
        $header = $request->headers->get('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            throw new UnauthorizedHttpException('Bearer', 'Missing or invalid Authorization header');
        }

        $token = trim(str_replace('Bearer', '', $header));
        $repository = new ToolRepository();

        // todo $tool = $repository->getByToken()

        return $next($request);
    }
}
