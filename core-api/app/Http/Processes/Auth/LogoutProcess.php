<?php

namespace App\Http\Processes\Auth;

use App\Models\User;

class LogoutProcess
{
    public function handle(User $user): void
    {
        $user->tokens()->delete();
    }
}
