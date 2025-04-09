<?php

namespace App\Factories;

use App\Http\Actions\AnalyzeHumidity;
use App\Http\Actions\AnalyzeLight;
use App\Http\Actions\AnalyzeTemperature;
use http\Exception\InvalidArgumentException;

class SignalDeviationAction
{
    public static function make(string $type, array $payload): object
    {
        return match ($type) {
            'temperature' => new AnalyzeTemperature($payload),
            'humidity' => new AnalyzeHumidity($payload),
            'light' => new AnalyzeLight($payload),
            default => throw new InvalidArgumentException("Unknown action type: $type"),
        };
    }
}
