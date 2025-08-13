<?php

namespace App\Http\Controllers;

use App\Domain\User\Processes\DeleteAccountProcess;
use App\Domain\User\Processes\FetchAuthenticatedUserProcess;
use App\Domain\User\Processes\UpdateAccountProcess;
use App\Http\Requests\User\UpdateAccountPreferencesRequest;
use App\Http\Responses\HttpResponse;
use App\System\Enums\ResponseMessage;

class UserController extends Controller
{
    public function showMe(FetchAuthenticatedUserProcess $process): HttpResponse
    {
        $response = $process->handle(auth()->id());

        return new HttpResponse(
            $response->toArray(),
        );
    }

    public function updateMyAccount(UpdateAccountPreferencesRequest $request, UpdateAccountProcess $process): HttpResponse
    {
        $requestData = $request->validated();

        $response = $process->handle(auth()->id(), $requestData);

        return new HttpResponse(
            $response->toArray(),
            ResponseMessage::UPDATE_SUCCESS->value
        );
    }

    public function deleteMyAccount(DeleteAccountProcess $process): HttpResponse
    {
        $id = auth()->id();
        $process->handle($id);

        return new HttpResponse(
            [],
            ResponseMessage::DELETE_SUCCESS->value
        );
    }
}
