<?php

namespace App\Domain\User\Processes;

use App\Domain\User\DTO\UserDTO;
use App\Domain\User\Repositories\UserRepository;

class UpdateAccountProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(int $id, array $data): UserDTO
    {
        $userData = $this->userRepository->updatePreferences($id, $data);
        $user = new UserDTO($userData);

        return $user;
    }
}
