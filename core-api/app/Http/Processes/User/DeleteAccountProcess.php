<?php

namespace App\Http\Processes\User;

use App\Repositories\UserRepository;

class DeleteAccountProcess
{
    public function __construct(UserRepository $userRepository)
    {
    }

    public function handle(int $id)
    {

    }
}
