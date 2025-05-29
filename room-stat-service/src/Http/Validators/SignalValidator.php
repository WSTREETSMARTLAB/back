<?php

namespace App\Http\Validators;

use Respect\Validation\Validator as v;


class SignalValidator
{
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            'temperature' => [
                v::notBlank(),
                v::floatVal(),
                v::min(-1),
                v::max(60),
            ],
            'humidity' => [
                v::notBlank(),
                v::floatVal(),
                v::min(0),
                v::max(95),
            ],
            'light' => [
                v::notBlank(),
                v::numericVal(),
                v::min(0),
                v::max(100),
            ]
        ];
    }

    public function validate(array $signal): array
    {
        foreach ($this->rules as $field => $validators) {
            $value = $signal[$field] ?? null;

            foreach ($validators as $validator) {
                if (!$validator->validate($value)) {
                    throw new \InvalidArgumentException("Invalid value for '$field': $value");
                }
            }
        }

        return $signal;
    }
}
