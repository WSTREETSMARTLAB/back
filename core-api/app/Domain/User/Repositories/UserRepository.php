<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Models\User;
use App\System\Abstract\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    protected string $model = User::class;

    public function create(array $data): Model
    {
        return $this->query()->create([
            'name' => $data['name'],
        ]);
    }

    public function getUserById(int $id): Model
    {
        return $this->query()->where('id', $id)->firstOrFail();
    }

    public function usernameExists(string $username): bool
    {
        return $this->query()->where('name', $username)->exists();
    }

    public function updatePreferences(int $id, array $data): User
    {
        $user = $this->getUserById($id);

        $user->update([
            'name' => $data['username'],
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
