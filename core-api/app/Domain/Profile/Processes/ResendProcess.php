<?php

namespace App\Domain\Profile\Processes;

use App\Domain\User\Actions\SendEmailVerificationCodeAction;
use App\Domain\User\Repositories\UserRepository;

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
