<?php

namespace App\Http\Processes\Auth;

use App\Actions\User\SendEmailVerificationCodeAction;
use App\Repositories\UserRepository;

class VerificationProcess
{
    public function __construct(private UserRepository $userRepository, private SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function handle(array $data): array
    {
        $user = $this->userRepository->findBy('email', $data['email']);

        if ($user->active) {
            throw new \Exception('User already verified.');
        }

        if ($user->email_verification_code !== $data['code']) {
            throw new \Exception('Invalid verification code');
        }

        if ($user->email_verification_code_expires_at < now()) {
            $this->sendEmailVerificationCodeAction->handle($user);
            throw new \Exception('Verification code has expired. New code sent to your email');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_code' => null,
            'email_verification_code_expires_at' => null,
            'active' => true
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'auth_token' => $token,
        ];
    }
}
