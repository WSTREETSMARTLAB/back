<?php

namespace App\Repositories;

use App\Domain\User\Models\User;

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

    public function getUserById(int $id): User
    {
        return $this->query()->where('id', $id)->firstOrFail();
    }

    public function usernameExists(string $username): bool
    {
        return $this->query()->where('username', $username)->exists();
    }

    public function updatePreferences(int $id, array $data): User
    {
        $user = $this->getUserById($id);

        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'avatar' => $data['avatar'] ?? null,
        ]);

        return $user->fresh();
    }

    public function deleteAccount(int $id): void
    {
        $user = $this->getUserById($id);

        $user->delete();
    }
}
