<?php

namespace App\DTO;

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

    public function __construct(array $data)
    {
        $this->minTemp = $data['min_temp'] ?? null;
        $this->maxTemp = $data['max_temp'] ?? null;
        $this->minHum = $data['min_hum'] ?? null;
        $this->maxHum = $data['max_hum'] ?? null;
        $this->lightDayThreshold = $data['light_day_threshold'] ?? null;
        $this->lightNightThreshold = $data['light_night_threshold'] ?? null;
        $this->dayStart = $data['day_start'] ?? null;
        $this->dayEnd = $data['day_end'] ?? null;
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

    public function all(): array
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
