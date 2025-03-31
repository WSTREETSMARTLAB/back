<?php

namespace App\Http\Validators;

class SignalCaster
{
    public function cast(mixed $value): int|float
    {
        if (is_null($value) || $value === '') return 0;

        if (is_numeric($value)) {
            return (str_contains((string)$value, '.') || str_contains((string)$value, 'e'))
                ? (float)$value
                : (int)$value;
        }

        return is_numeric($value) ? ((float)$value == (int)$value ? (int)$value : (float)$value) : 0;
    }

    public function all(array $values): array
    {
        return array_map([$this, 'cast'], $values);
    }
}
