<?php

namespace App\Http\Controllers;

use App\Domain\Guest\Processes\GuestRegisterProcess;
use App\Http\Requests\Guest\GuestRegisterRequest;
use App\Http\Responses\HttpResponse;
use App\System\Enums\ResponseMessage;

class GuestController extends Controller
{
    public function registerGuest(GuestRegisterRequest $request, GuestRegisterProcess $process): HttpResponse
    {
        $requestData = $request->getValidatedData();

        $process->handle($requestData);

        return new HttpResponse(
            [],
            ResponseMessage::REGISTER_SUCCESS->value
        );
    }
}
