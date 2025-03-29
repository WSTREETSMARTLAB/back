<?php

namespace App\Http\Validators;

use Respect\Validation\Validator as v;


class SignalValidator
{
    public function __construct(private array $signal)
    {
    }

    public function validate(array $rules): array
    {


        return [
            "temperature" => "27.5",
            "humidity" => "40%",
            "light" => "80",
        ];
    }
}
