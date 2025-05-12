<?php

namespace App\Repositories;

use App\Models\Tool;
use Illuminate\Support\Collection;

class ToolRepository extends Repository
{
    protected string $model = Tool::class;

    public function getToolsByUserId(int $id): Collection
    {
        return $this->query()
            ->where('user_id', $id)
            ->get();
    }

    public function getToolByUserId(int $userId, int $toolId): Tool
    {
        return $this->query()->where('user_id', $userId)->findOrFail($toolId);
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
                'min_temp' => $data['min_temp'] ?? null,
                'max_temp' => $data['max_temp'] ?? null,
                'min_hum' => $data['min_hum'] ?? null,
                'max_hum' => $data['max_hum'] ?? null,
                'light_control_enabled' => $data['light_control_enabled'] ?? false,
                'timezone' => $data['timezone'] ?? null,
                'day_start' => $data['day_start'] ?? null,
                'light_day_threshold' => $data['light_day_threshold'] ?? null,
                'light_night_threshold' => $data['light_night_threshold'] ?? null,
            ];

        $tool->save();

        return $tool->settings;
    }
}
