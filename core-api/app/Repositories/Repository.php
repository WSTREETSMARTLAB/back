<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    public function query(): Builder
    {
        return app($this->model)->newQuery();
    }

    public function findBy(string $column, mixed $value): Model
    {
        return $this->query()->where($column, $value)->firstOrFail();
    }
}
