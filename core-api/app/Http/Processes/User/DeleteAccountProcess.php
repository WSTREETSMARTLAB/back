<?php

namespace App\Http\Processes\User;

use App\Repositories\UserRepository;

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
