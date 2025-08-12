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
use App\Http\Responses\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return new HttpResponse(
            [],
            'Verification code sent to email'
        );
    }

    public function verify(VerificationRequest $request, VerificationProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return new HttpResponse(
            $response,
            'Verification successful'
        );
    }

    public function resend(ResendRequest $request, ResendProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return new HttpResponse(
            [],
            'Verification code sent to email'
        );
    }

    public function login(LoginRequest $request, LoginProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return new HttpResponse(
            ['auth_token' => $response],
            'Login successful'
        );
    }

    public function logout(LogoutProcess $process): HttpResponse
    {
        $user = auth()->user();

        $process->handle($user);

        return new HttpResponse(
            [],
            'Logout successful'
        );
    }
}
