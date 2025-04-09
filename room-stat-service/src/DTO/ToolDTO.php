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
        $this->settings = [
            'min_temp' => $data['settings']['min_temp'],
            'max_temp' => $data['settings']['max_temp'],
            'min_hum' => $data['settings']['min_hum'],
            'max_hum' => $data['settings']['max_hum'],
            'light_day_threshold' => $data['settings']['light_day_threshold'],
            'light_night_threshold' => $data['settings']['light_night_threshold'],
            'day_start' => $data['settings']['day_start'],
            'day_end' => $data['settings']['day_end'],
        ];
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
