<?php

namespace App\Http\Controllers;

use App\Http\Processes\Auth\AuthorizeProcess;
use App\Http\Processes\Auth\LoginProcess;
use App\Http\Processes\Auth\LogoutProcess;
use App\Http\Processes\Auth\RegisterProcess;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(AuthRequest $request, RegisterProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return response()->json($response, Response::HTTP_OK);
    }

    public function login(AuthRequest $request, LoginProcess $process): JsonResponse
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

    public function authorize(Request $request, AuthorizeProcess $process): JsonResponse
    {
        $response = $process->handle();

        return response()->json($response, Response::HTTP_OK);
    }
}
