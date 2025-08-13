<?php

namespace App\Domain\Guest\Repositories;

use App\Domain\Guest\DTO\GuestDTO;
use App\Domain\Guest\Models\Guest;
use App\System\Abstract\Repository;

class GuestRepository extends Repository
{
    protected string $model = Guest::class;

    public function storeMeta(GuestDTO $data): void
    {
        $this->query()->create($data->toArray());
    }
}
