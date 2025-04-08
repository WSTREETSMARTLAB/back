<?php

namespace App\DTO\Tool;

use App\Models\Tool;

class ToolSettingsDTO
{
    private ?float $minTemp;
    private ?float $maxTemp;
    private ?int $minHum;
    private ?int $maxHum;
    private ?int $lightDayThreshold;
    private ?int $lightNightThreshold;
    private ?string $dayStart;
    private ?string $dayEnd;

    public function __construct(Tool $data)
    {
        $this->minTemp = $data['settings']['min_temp'] ?? null;
        $this->maxTemp = $data['settings']['max_temp'] ?? null;
        $this->minHum = $data['settings']['min_hum'] ?? null;
        $this->maxHum = $data['settings']['max_hum'] ?? null;
        $this->lightDayThreshold = $data['settings']['light_day_threshold'] ?? null;
        $this->lightNightThreshold = $data['settings']['light_night_threshold'] ?? null;
        $this->dayStart = $data['settings']['day_start'] ?? null;
        $this->dayEnd = $data['settings']['day_end'] ?? null;
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

    public function lightDayThreshold(): ?float
    {
        return $this->lightDayThreshold;
    }

    public function lightNightThreshold(): ?float
    {
        return $this->lightNightThreshold;
    }

    public function dayStart(): ?string
    {
        return $this->dayStart;
    }

    public function dayEnd(): ?string
    {
        return $this->dayEnd;
    }

    public function toArray(): array
    {
        return [
            'min_temp' => $this->minTemp,
            'max_temp' => $this->maxTemp,
            'min_hum' => $this->minHum,
            'max_hum' => $this->maxHum,
            'light_day_threshold' => $this->lightDayThreshold,
            'light_night_threshold' => $this->lightNightThreshold,
            'day_start' => $this->dayStart,
            'day_end' => $this->dayEnd,
        ];
    }
}
