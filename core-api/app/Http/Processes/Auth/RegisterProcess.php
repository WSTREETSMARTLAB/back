<?php

namespace App\Http\Processes\Auth;

use App\Actions\User\SendEmailVerificationCodeAction;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterProcess
{
    public function __construct(private UserRepository $userRepository, private SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function handle(array $data): void
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        $this->sendEmailVerificationCodeAction->handle($user);
    }
}
