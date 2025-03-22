<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected string $model = User::class;

    public function create(array $data): User
    {
        return $this->query()->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
