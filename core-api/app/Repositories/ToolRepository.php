<?php

namespace App\Repositories;

use App\Models\Tool;
use Illuminate\Support\Collection;

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

    public function userIsOwner(int $toolId, int $userId): bool
    {
        return $this->query()->where('id', $toolId)->where('user_id', $userId)->exists();
    }

    public function getToolSettingsById(int $id): array
    {
        $tool = $this->query()->findOrFail($id);

        return $tool->settings;
    }

    public function createTool(array $data): Tool
    {
        return $this->query()->create([
            'type' => $data['type'],
            'user_id' => $data['user_id'],
            'company_id' => $data['company_id'],
            'active' => $data['is_active'],
            'code' => $data['code'],
            'activated_at' => $data['activated_at'],
            'name' => $data['name'],
            'location_note' => $data['location_note'],
            'last_online_at' => $data['last_online_at'],
            'firmware_version' => $data['firmware_version'],
            'settings' => $data['settings'],
        ]);
    }

    public function updateToolSetting(int $id, array $data): array
    {
        $tool = $this->query()->findOrFail($id);

        $tool->settings =
            [
                'min_temp' => $data['min_temp'],
                'max_temp' => $data['max_temp'],
                'min_hum' => $data['min_hum'],
                'max_hum' => $data['max_hum'],
                'light_day_threshold' => $data['light_day_threshold'],
                'light_night_threshold' => $data['light_night_threshold'],
                'day_start' => $data['day_start'],
                'day_end' => $data['day_end']
            ];

        $tool->save();

        return $tool->settings;
    }
}
