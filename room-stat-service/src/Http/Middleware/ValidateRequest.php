<?php

namespace App\Http\Middleware;

use App\DTO\SignalDTO;
use App\Http\Validators\SignalCaster;
use Symfony\Component\HttpFoundation\Request;

class ValidateRequest
{
    public function handle(Request $request, callable $next): SignalDTO
    {
        $requestData = json_decode($request->getContent(), true);

        $castedData = (new SignalCaster())->all($requestData);

        $signal = new SignalDTO($castedData);

        return $next($signal);
    }
}
