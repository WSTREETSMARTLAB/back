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
            ->where('type', 'room-stat')
            ->get();
    }

    public function createTool(array $data): Tool
    {
        return $this->query()->create([
            'type' => $data['type'],
            'user_id' => $data['user_id'],
            'company_id' => $data['company_id'],
            'is_active' => $data['is_active'],
            'code' => $data['code'],
            'activated_at' => $data['activated_at'],
            'name' => $data['name'],
            'location_note' => $data['location_note'],
            'last_online_at' => $data['last_online_at'],
            'firmware_version' => $data['firmware_version'],
            'meta' => $data['meta'],
        ]);
    }
}
