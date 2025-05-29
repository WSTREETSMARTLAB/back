<?php

namespace App\Http\Controllers;

use App\Http\Processes\Auth\LoginProcess;
use App\Http\Processes\Auth\LogoutProcess;
use App\Http\Processes\Auth\RegisterProcess;
use App\Http\Processes\Auth\ResendProcess;
use App\Http\Processes\Auth\VerificationProcess;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendRequest;
use App\Http\Requests\Auth\VerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return response()->json([
            'message' => 'Verification code sent to email',
        ], Response::HTTP_OK);
    }

    public function verify(VerificationRequest $request, VerificationProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return response()->json([
            'message' => 'Verification successful',
            'data' => $response
        ], Response::HTTP_OK);
    }

    public function resend(ResendRequest $request, ResendProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return response()->json([
            'message' => 'Verification code sent to email',
        ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request, LoginProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'auth_token' => $response
            ]
        ], Response::HTTP_OK);
    }

    public function logout(LogoutProcess $process): JsonResponse
    {
        $user = auth()->user();

        $process->handle($user);

        return response()->json([
            'message' => 'Logout successful',
        ], Response::HTTP_OK);
    }
}
