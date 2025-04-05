<?php

namespace App\Repositories;

use App\Models\Tool;

class ToolRepository extends Repository
{
    protected string $model = Tool::class;

    public function getRoomStatToolsByUserId(int $id)
    {
        return $this->query()
            ->where('user_id', $id)
            ->where('type', 'room_stat')
            ->get();
    }
}
