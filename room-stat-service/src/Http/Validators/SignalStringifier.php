<?php

namespace App\Http\Validators;

class SignalStringifier
{
    public function stringify(mixed $value): string
    {
        if (is_null($value)) return '';
        if (is_scalar($value)) return (string)$value;
        if (is_array($value)) return json_encode($value, JSON_UNESCAPED_UNICODE);
        if (is_object($value) && method_exists($value, '__toString')) return (string)$value;

        return '[object ' . get_class($value) . ']';
    }

    public function all(array $values): array
    {
        return array_map([$this, 'stringify'], $values);
    }
}
