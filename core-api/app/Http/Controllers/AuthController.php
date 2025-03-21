<?php

namespace App\Http\Controllers;

use App\Http\Processes\Auth\LoginProcess;
use App\Http\Processes\Auth\LogoutProcess;
use App\Http\Processes\Auth\RegisterProcess;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return response()->json($response, Response::HTTP_OK);
    }

    public function login(LoginRequest $request, LoginProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return response()->json($response, Response::HTTP_OK);
    }

    public function logout(LogoutProcess $process): JsonResponse
    {
        $response = $process->handle();

        return response()->json($response, Response::HTTP_OK);
    }
}
