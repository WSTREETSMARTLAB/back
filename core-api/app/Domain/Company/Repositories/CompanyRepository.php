<?php

namespace App\Domain\Company\Repositories;

use App\Domain\Company\Models\Company;
use App\System\Abstract\Repository;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends Repository
{
    protected string $model = Company::class;

    public function create(array $data): Model
    {
        return $this->query()->create([
            'name' => $data['name'],
            'profile_id' => $data['profile_id']
        ]);
    }

    public function usernameExists(string $username): bool
    {
        return $this->query()->where('name', $username)->exists();
    }
}
