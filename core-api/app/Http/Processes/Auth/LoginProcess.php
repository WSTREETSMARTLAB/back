<?php

namespace App\Http\Processes\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(array $data)
    {
        $user = $this->userRepository->findBy('email', $data['email']);

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'email' => ['Email address is not verified.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'auth_token' => $token,
        ];
    }
}
