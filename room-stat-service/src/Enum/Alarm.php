<?php

namespace App\Enum;

enum Alarm: string
{

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
