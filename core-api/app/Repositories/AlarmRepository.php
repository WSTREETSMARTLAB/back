<?php

namespace App\Repositories;

use App\Models\Alarm;
use Illuminate\Pagination\LengthAwarePaginator;

class AlarmRepository extends Repository
{
    protected string $model = Alarm::class;

    public function forTool(int $toolId, int $perPage = 15): LengthAwarePaginator
    {
        $data = $this->query()
            ->where("tool_id", $toolId)
            ->orderBy('start', 'desc')
            ->paginate($perPage);

        return $data;
    }
}
