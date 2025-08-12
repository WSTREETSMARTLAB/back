<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessage;
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

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return new HttpResponse(
            [],
            ResponseMessage::CODE_SENT_TO_EMAIL->value
        );
    }

    public function verify(VerificationRequest $request, VerificationProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return new HttpResponse(
            $response,
            ResponseMessage::VERIFICATION_SUCCESS->value
        );
    }

    public function resend(ResendRequest $request, ResendProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $process->handle($requestData);

        return new HttpResponse(
            [],
            ResponseMessage::CODE_SENT_TO_EMAIL->value
        );
    }

    public function login(LoginRequest $request, LoginProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $response = $process->handle($requestData);

        return new HttpResponse(
            ['auth_token' => $response],
            ResponseMessage::LOGIN_SUCCESS->value
        );
    }

    public function logout(LogoutProcess $process): HttpResponse
    {
        $user = auth()->user();

        $process->handle($user);

        return new HttpResponse(
            [],
            ResponseMessage::LOGOUT_SUCCESS->value
        );
    }
}
