<?php

namespace App\Domain\Profile\Processes;

use App\Domain\User\Models\User;

class LogoutProcess
{
    public function handle(User $user): void
    {
        $user->tokens()->delete();
    }
}
