<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

class Repository
{
    public function query(): Builder
    {
        return app($this->model)->newQuery();
    }
}
