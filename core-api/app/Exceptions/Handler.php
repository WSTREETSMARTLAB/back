<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {
                return $this->handleApiException($exception);
            }
        });
    }

    /**
     * Handle API exceptions and return JSON response.
     */
    private function handleApiException(Throwable $exception): JsonResponse
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Route not found',
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthorized',
                'error' => 'Authentication required',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return response()->json([
                'message' => 'Forbidden',
                'error' => 'Access denied',
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'error' => $exception->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
