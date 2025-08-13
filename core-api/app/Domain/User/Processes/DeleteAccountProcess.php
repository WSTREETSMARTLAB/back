<?php

namespace App\Domain\User\Processes;

use App\Domain\User\Repositories\UserRepository;

class DeleteAccountProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(int $id): bool
    {
        return $this->userRepository->deleteAccount($id);
    }
}
