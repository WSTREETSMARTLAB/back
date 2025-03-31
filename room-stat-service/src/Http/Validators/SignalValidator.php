<?php

namespace App\Http\Validators;

use App\DTO\SignalDTO;
use Respect\Validation\Validator as v;


class SignalValidator
{
    private array $rules = [
        'temperature' => ['required', 'integer', 'min:-1', 'max:60'],
        'humidity' => ['required', 'numeric', 'between:0,100'],
        'light' => ['required', 'numeric', 'between:0,100'],
    ];

    public function __construct(private array $signal)
    {
    }

    public function validate(): SignalDTO
    {
        $signal = $this->signal;

        return new SignalDTO($signal);
    }
}
