<?php

namespace App\Http\Validators;

use App\DTO\SignalDTO;
use App\DTO\ToolDTO;
use App\Factories\SignalDeviationAction;

class SignalDeviationAnalyzer
{

    private ?array $settings;

    public function __construct(ToolDTO $tool)
    {
        $this->settings = $tool->settings();
    }

    public function analyze(SignalDTO $signal): void
    {
        foreach ($signal->all() as $index => $item) {
            $factory = SignalDeviationAction::make($index, $this->settings);
            $factory->handle($item);
        }
    }
}
