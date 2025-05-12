<?php

namespace App\DTO\Tool;

use App\Models\Tool;
use Illuminate\Support\Collection;

class ToolSettingsDTO
{
    private ?float $minTemp;
    private ?float $maxTemp;
    private ?int $minHum;
    private ?int $maxHum;
    private bool $lightControlEnabled;
    private ?string $timezone;
    private ?string $dayStart;
    private ?int $lightDayThreshold;
    private ?int $lightNightThreshold;

    public function __construct(array $data)
    {
        $this->minTemp = $data['min_temp'] ?? null;
        $this->maxTemp = $data['max_temp'] ?? null;
        $this->minHum = $data['min_hum'] ?? null;
        $this->maxHum = $data['max_hum'] ?? null;
        $this->lightControlEnabled = $data['light_control_enabled'] ?? false;
        $this->timezone = $data['timezone'] ?? null;
        $this->dayStart = $data['day_start'] ?? null;
        $this->lightDayThreshold = $data['light_day_threshold'] ?? null;
        $this->lightNightThreshold = $data['light_night_threshold'] ?? null;
    }

    public function minTemp(): ?float
    {
        return $this->minTemp;
    }

    public function maxTemp(): ?float
    {
        return $this->maxTemp;
    }

    public function minHum(): ?float
    {
        return $this->minHum;
    }

    public function maxHum(): ?float
    {
        return $this->maxHum;
    }

    public function lightControlEnabled(): bool
    {
        return $this->lightControlEnabled;
    }

    public function timezone(): ?string
    {
        return $this->timezone;
    }

    public function dayStart(): ?string
    {
        return $this->dayStart;
    }


    public function lightDayThreshold(): ?float
    {
        return $this->lightDayThreshold;
    }

    public function lightNightThreshold(): ?float
    {
        return $this->lightNightThreshold;
    }

    public function toArray(): array
    {
        return [
            'min_temp' => $this->minTemp(),
            'max_temp' => $this->maxTemp(),
            'min_hum' => $this->minHum(),
            'max_hum' => $this->maxHum(),
            'light_control_enabled' => $this->lightControlEnabled(),
            'timezone' => $this->timezone(),
            'light_day_threshold' => $this->lightDayThreshold(),
            'light_night_threshold' => $this->lightNightThreshold(),
            'day_start' => $this->dayStart(),
        ];
    }
}
