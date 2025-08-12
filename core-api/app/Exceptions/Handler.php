<?php

namespace App\Exceptions;

use App\Enums\ResponseMessage;
use App\Http\Responses\HttpResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
            'message' => ResponseMessage::HTTP_NOT_FOUND->value,
            'code' => Response::HTTP_NOT_FOUND
        ],
        AuthenticationException::class => [
            'message' => ResponseMessage::UNAUTHORIZED->value,
            'code' => Response::HTTP_UNAUTHORIZED
        ],
        AuthorizationException::class => [
            'message' => ResponseMessage::FORBIDDEN->value,
            'code' => Response::HTTP_FORBIDDEN,
        ],
        AccessDeniedHttpException::class => [
            'message' => ResponseMessage::FORBIDDEN->value,
            'code' => Response::HTTP_FORBIDDEN
        ],
        ValidationException::class => [
            'message' => ResponseMessage::VALIDATION_ERROR->value,
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY
        ],
        ModelNotFoundException::class => [
            'message' => ResponseMessage::NOT_FOUND->value,
            'code' => Response::HTTP_NOT_FOUND,
        ],
        MethodNotAllowedHttpException::class => [
            'message' => ResponseMessage::METHOD_NOT_ALLOWED->value,
            'code' => Response::HTTP_METHOD_NOT_ALLOWED,
        ],
        ThrottleRequestsException::class => [
            'message' => ResponseMessage::TOO_MANY_REQUESTS->value,
            'code' => Response::HTTP_TOO_MANY_REQUESTS,
        ],
        QueryException::class => [
            'message' => ResponseMessage::QUERY_EXCEPTION->value,
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        ],
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
                break;
            }
        }

        if ((app()->isProduction()) && ($exception instanceof QueryException)) {
            $payload['error'] = ResponseMessage::SERVER_ERROR->value;
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
