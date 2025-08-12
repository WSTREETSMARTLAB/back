<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessage;
use App\Http\Processes\User\DeleteAccountProcess;
use App\Http\Processes\User\FetchAuthenticatedUserProcess;
use App\Http\Processes\User\UpdateAccountProcess;
use App\Http\Requests\User\UpdateAccountPreferencesRequest;
use App\Http\Responses\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function showMe(FetchAuthenticatedUserProcess $process): JsonResponse
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response->toArray()
        ], Response::HTTP_OK);
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
