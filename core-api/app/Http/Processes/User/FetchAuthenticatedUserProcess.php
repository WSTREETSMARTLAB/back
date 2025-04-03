<?php

namespace App\Http\Processes\User;

use App\DTO\User\UserDTO;
use App\Repositories\UserRepository;

class FetchAuthenticatedUserProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(): UserDTO
    {
        $user = $this->userRepository->getAuthenticatedUser();

        return new UserDTO($user->toArray());
    }
}
