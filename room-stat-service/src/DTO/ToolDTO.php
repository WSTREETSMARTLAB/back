<?php

namespace App\DTO;

class ToolDTO
{
    private int $id;
    private string $type;
    private string $name;
    private int $userId;
    private ?int $companyId;
    private ?array $settings;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->userId = $data['user_id'];
        $this->companyId = $data['company_id'];
        $this->name = $data['name'];
        $this->settings = $data['settings'] ? [
            'min_temp' => $data['settings']['min_temp'] ?? null,
            'max_temp' => $data['settings']['max_temp'] ?? null,
            'min_hum' => $data['settings']['min_hum'] ?? null,
            'max_hum' => $data['settings']['max_hum'] ?? null,
            'light_control_enabled' => $data['settings']['light_control_enabled'] ?? false,
            'timezone' => $data['settings']['timezone'] ?? null,
            'day_start' => $data['settings']['day_start'] ?? null,
            'day_period' => $data['settings']['day_period'] ?? null,
            'light_day_threshold' => $data['settings']['light_day_threshold'] ?? null,
            'light_night_threshold' => $data['settings']['light_night_threshold'] ?? null,
        ] : null;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function companyId(): ?int
    {
        return $this->companyId;
    }

    public function settings(): ?array
    {
        return $this->settings;
    }

    public function all(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'user_id' => $this->userId,
            'company_id' => $this->companyId,
            'settings' => $this->settings,
        ];
    }
}
