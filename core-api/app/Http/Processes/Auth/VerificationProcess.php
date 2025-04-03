<?php

namespace App\Http\Processes\Auth;

use App\Repositories\UserRepository;

class VerificationProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(array $data): array
    {
        $user = $this->userRepository->findBy('email', $data['email']);

        if ($user->email_verification_code !== $data['code']) {
            throw new \Exception('Invalid verification code');
        }

        if ($user->email_verification_code_expires_at < now()) {
            throw new \Exception('Verification code has expired');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_code' => null,
            'email_verification_code_expires_at' => null
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'auth_token' => $token,
        ];
    }
}
