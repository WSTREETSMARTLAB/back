<?php

namespace App\Http\Controllers;

use App\Http\Processes\User\DeleteAccountProcess;
use App\Http\Processes\User\FetchAuthenticatedUserProcess;
use App\Http\Processes\User\UpdateAccountProcess;
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

    public function updateMyAccount(UpdateAccountProcess $process): JsonResponse
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response
        ], Response::HTTP_OK);
    }

    public function deleteMyAccount(DeleteAccountProcess $process): JsonResponse
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response
        ], Response::HTTP_OK);
    }
}
