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
}
