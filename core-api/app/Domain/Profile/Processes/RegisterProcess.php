<?php

namespace App\Domain\Profile\Processes;

use App\Domain\User\Actions\SendEmailVerificationCodeAction;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterProcess
{
    public function __construct(private UserRepository $userRepository, private SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function handle(array $data): void
    {
        DB::beginTransaction();

        try {
            $data['password'] = Hash::make($data['password']);
            $data['username'] = $this->generateUniqueUsername();

            $user = $this->userRepository->create($data);

            $this->sendEmailVerificationCodeAction->handle($user);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    private function generateUniqueUsername(): string
    {
        do {
            $username = 'user_' . Str::random(6);
        } while ($this->userRepository->usernameExists($username));

        return $username;
    }
}
