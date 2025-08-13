<?php

namespace App\Http\Controllers;

use App\Domain\Guest\Processes\GuestRegisterProcess;
use App\Enums\ResponseMessage;
use App\Http\Requests\Guest\GuestRegisterRequest;
use App\Http\Responses\HttpResponse;

class GuestController extends Controller
{
    public function registerGuest(GuestRegisterRequest $request, GuestRegisterProcess $process): HttpResponse
    {
        $requestData = $request->validated();

        $process->handle($requestData);

        return new HttpResponse(
            [],
            ResponseMessage::REGISTER_SUCCESS->value
        );
    }
}
