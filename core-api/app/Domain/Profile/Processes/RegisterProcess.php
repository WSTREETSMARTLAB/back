<?php

namespace App\Domain\Profile\Processes;

use App\Domain\Company\Repositories\CompanyRepository;
use App\Domain\Profile\Repositories\ProfileRepository;
use App\Domain\User\Actions\SendEmailVerificationCodeAction;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterProcess
{
    public function __construct(
        private ProfileRepository $profileRepository,
        private UserRepository $userRepository,
        private CompanyRepository $companyRepository,
        private SendEmailVerificationCodeAction $sendEmailVerificationCodeAction
    )
    {
    }

    public function handle(array $data): void
    {
        DB::beginTransaction();

        try {
            $profile = $this->createProfile($data['email'], $data['password']);

            $entityData['name'] = $this->generateUniqueUsername();
            $entityData['profile_id'] = $profile->id;

            if ($data['type'] === 'user') {
                $this->userRepository->create($entityData);
            }

            if ($data['type'] === 'company') {
                $this->companyRepository->create($entityData);
            }

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    private function createProfile(string $email, string $password): Model
    {
        $password = Hash::make($password);

        $profile = $this->profileRepository->create([
            'email' => $email,
            'password' => $password
        ]);

        $this->sendEmailVerificationCodeAction->handle($profile);

        return $profile;
    }

    private function generateUniqueUsername(): string
    {
        do {
            $username = 'user_' . Str::random(6);
        } while ($this->userRepository->usernameExists($username));

        return $username;
    }
}
