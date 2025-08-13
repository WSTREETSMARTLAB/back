<?php

namespace App\Domain\Profile\Processes;

use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(array $data): string
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

        return $token;
    }
}
