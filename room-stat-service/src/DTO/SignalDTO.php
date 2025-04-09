<?php

namespace App\DTO;

class SignalDTO
{
    private float $temperature;
    private int $humidity;
    private int $light;

    public function __construct(array $data)
    {
        $this->temperature = $data['temperature'];
        $this->humidity = $data['humidity'];
        $this->light = $data['light'];
    }

    public function temperature(): float
    {
        return $this->temperature;
    }

    public function humidity(): int
    {
        return $this->humidity;
    }

    public function light(): int
    {
        return $this->light;
    }

    public function all(): array
    {
        return [
            'temperature' => $this->temperature(),
            'humidity' => $this->humidity(),
            'light' => $this->light(),
        ];
    }
}
