<?php

namespace App\Repositories;

use App\Models\Alarm;
use Illuminate\Support\Collection;

class AlarmRepository extends Repository
{
    protected string $model = Alarm::class;

    public function forTool(int $toolId): Collection
    {
        $data = $this->query()
            ->where("tool_id", $toolId)
            ->orderBy('start', 'desc')
            ->get();

        return $data;
    }
}
