<?php

namespace App\Domain\Tool\Enums;

enum ToolType: string
{
    case ROOM_STAT = 'room-stat';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
