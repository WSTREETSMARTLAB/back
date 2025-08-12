<?php

namespace App\Exceptions;

use App\Http\Responses\HttpResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
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

    private $errors = [
        NotFoundHttpException::class => [
            'message' => 'Route not found',
            'code' => Response::HTTP_NOT_FOUND
        ],
        AuthenticationException::class => [
            'message' => 'Unauthorized',
            'code' => Response::HTTP_UNAUTHORIZED
        ],
        AccessDeniedHttpException::class => [
            'message' => 'Access denied',
            'code' => Response::HTTP_FORBIDDEN
        ],
        ValidationException::class => [
            'message' => 'The given data was invalid',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY
        ]
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
    private function handleApiException(Throwable $exception): HttpResponse
    {
        $payload = [
            'error' => $exception instanceof ValidationException ? $exception->errors() : $exception->getMessage(),
            'message' => 'Server Error',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR
        ];

        foreach ($this->errors as $index => $error) {
            if ($exception instanceof $index) {
                $payload['message'] = $error['message'];
                $payload['code'] = $error['code'];
            }
        }

        return new HttpResponse(
            [
                'error' => $payload['error']
            ],
            $payload['message'],
            false,
            $payload['code']
        );
    }
}
