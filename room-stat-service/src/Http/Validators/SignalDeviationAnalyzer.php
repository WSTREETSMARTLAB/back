<?php

namespace App\Http\Validators;

use App\DTO\SignalDTO;
use App\DTO\ToolDTO;

class SignalDeviationAnalyzer
{
    private ?array $settings;

    public function __construct(ToolDTO $tool)
    {
        $this->settings = $tool->settings();
    }

    public function analyze(SignalDTO $signal): array
    {

        return [];
    }
}
