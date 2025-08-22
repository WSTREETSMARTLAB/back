<?php

namespace App\Domain\Profile\Repositories;

use App\Domain\Profile\Models\Profile;
use App\System\Abstract\Repository;
use Illuminate\Database\Eloquent\Model;

class ProfileRepository extends Repository
{
    protected $model = Profile::class;

    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }
}
