<?php

namespace App\Http\Validators;

class SignalValidator
{
    public function __construct(private array $signal)
    {
    }

    public function validate(): array
    {
        return [
            "temperature" => "27.5",
            "humidity" => "40%",
            "light" => "80",
        ];
    }
}
