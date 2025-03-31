<?php

namespace App\Http\Middleware;

use App\Core\DependencyAccessor;
use App\Repositories\ToolRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authorize
{
    private ToolRepository $toolRepository;
    private \Redis $session;

    public function __construct()
    {
        $this->toolRepository = new ToolRepository((new DependencyAccessor())->db());
        $this->session = (new DependencyAccessor())->session();
    }

    public function handle(mixed $request, callable $next): mixed
    {
        if (!$request instanceof Request) {
            throw new UnauthorizedHttpException('Request', 'Invalid request parameters.');
        }

        $header = $request->headers->get('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            throw new UnauthorizedHttpException('Bearer', 'Missing or invalid Authorization header');
        }

        $token = trim(str_replace('Bearer', '', $header));
        $tool = $this->toolRepository->getByToken($token);

        $this->session->set('token', $token);
        $this->session->set('tool', $tool);

        return $next($request);
    }
}
