<?php

namespace App\Domain\Guest\Repositories;

use App\Domain\Guest\DTO\GuestDTO;
use App\Domain\Guest\Models\Guest;
use App\System\Abstract\Repository;
use Illuminate\Database\Eloquent\Model;

class GuestRepository extends Repository
{
    protected string $model = Guest::class;

    public function storeMeta(GuestDTO $data): Model
    {
        return $this->query()->create($data->toArray());
    }
}
