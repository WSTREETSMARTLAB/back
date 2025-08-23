<?php

namespace App\Domain\Profile\Processes;

use App\Domain\Company\Repositories\CompanyRepository;
use App\Domain\Profile\Enums\ProfileType;
use App\Domain\Profile\Repositories\ProfileRepository;
use App\Domain\User\Actions\SendEmailVerificationCodeAction;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterProcess
{
    private UserRepository|CompanyRepository $entityRepository;

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
            $entity = $this->createEntity($data['type'])->id;
            $data['owner_id'] = $entity->id;
            $this->createProfile($data);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    private function createEntity(string $type): Model
    {
        $this->entityRepository = app()->make(
            $type === ProfileType::USER->value ? UserRepository::class : CompanyRepository::class
        );

        $entityData = [
            'name' => $this->generateUniqueUsername(),
        ];

        return $this->entityRepository->create($entityData);
    }

    private function createProfile(array $data): void
    {
        $password = Hash::make($data['password']);

        $profile = $this->profileRepository->create([
            'email' => $data['email'],
            'password' => $password,
            'owner_id' => $data['owner_id'],
            'owner_type' => $data['type'],
            'active' => false
        ]);

        $this->sendEmailVerificationCodeAction->handle($profile);
    }

    private function generateUniqueUsername(): string
    {
        do {
            $username = '_' . Str::random(6);
        } while ($this->entityRepository->usernameExists($username));

        return $username;
    }
}
