<?php

namespace App\Domain\User\Processes;

use App\Domain\User\DTO\UserDTO;
use App\Domain\User\Repositories\UserRepository;

class FetchAuthenticatedUserProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(int $id): UserDTO
    {
        $user = $this->userRepository->getUserById($id);

        return new UserDTO($user);
    }
}
