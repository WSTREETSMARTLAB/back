<?php

namespace App\Http\Responses;

use App\Enums\ResponseMessage;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HttpResponse implements Responsable
{
    public function __construct(
        private readonly array $data = [],
        private readonly string $message = '',
        private readonly bool $success = true,
        private readonly int $code = Response::HTTP_OK,
        private readonly array $headers = [],
    ) {
        //
    }

    public function toResponse($request): JsonResponse|Response
    {
        $response = [
            'success' => $this->success,
        ];

        if (!empty($this->message)) {
            $response['message'] = $this->message;
        }

        if (!empty($this->data)) {
            $response['data'] = $this->data;
        }

        return response()->json(
            $response,
            $this->code,
            $this->headers
        );
    }
}
