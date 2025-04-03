<?php

namespace App\Http\Processes\Auth;

use App\Actions\User\SendEmailVerificationCodeAction;
use App\Repositories\UserRepository;

class ResendProcess
{
    public function __construct(private UserRepository $userRepository, private SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function handle(array $data): void
    {
        $user = $this->userRepository->findBy('email', $data['email']);

        $this->sendEmailVerificationCodeAction->handle($user);
    }
}
