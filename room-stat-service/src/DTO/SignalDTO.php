<?php

namespace App\DTO;

class SignalDTO
{
    public function __construct(
        public readonly string $temperature,
        public readonly string $humidity,
        public readonly string $light
    )
    {
    }
}
