<?php

namespace App\Http\Controllers;

use App\Http\Processes\User\DeleteAccountProcess;
use App\Http\Processes\User\FetchAuthenticatedUserProcess;
use App\Http\Processes\User\UpdateAccountProcess;
use App\Http\Requests\User\UpdateAccountPreferencesRequest;
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

    public function updateMyAccount(UpdateAccountPreferencesRequest $request, UpdateAccountProcess $process): JsonResponse
    {
        $requestData = $request->validated();

        $response = $process->handle(auth()->id(), $requestData);

        return response()->json([
            'data' => $response->toArray()
        ], Response::HTTP_OK);
    }

    public function deleteMyAccount(DeleteAccountProcess $process): JsonResponse
    {
        $id = auth()->id();
        $response = $process->handle($id);

        return response()->json([
            'data' => $response ? "Account {$id} deleted" : "Account {$id} delete error"
        ], Response::HTTP_OK);
    }
}
