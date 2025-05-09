<?php

namespace App\Http\Processes\User;

use App\DTO\User\UserDTO;
use App\Repositories\UserRepository;

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
