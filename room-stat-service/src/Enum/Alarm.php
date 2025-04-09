<?php

namespace App\Enum;

enum Alarm: string
{
    case TEMP_LOW = 'Detected Low Temperature level on area';
    case TEMP_HIGH = 'Detected High Temperature level on area';
    case HUM_LOW = 'Detected Low Humidity level on area';
    case HUM_HIGH = 'Detected High Humidity level on area';
    case LIGHT_ON_NIGHT = 'Detected High Light level on night period';
    case LIGHT_OFF_DAY = 'Detected Low Light level in the day period';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function code(): string
    {
        return match($this) {
            self::TEMP_LOW => 'temp_low',
            self::TEMP_HIGH => 'temp_high',
            self::HUM_LOW => 'hum_low',
            self::HUM_HIGH => 'hum_high',
            self::LIGHT_ON_NIGHT => 'light_on_night',
            self::LIGHT_OFF_DAY => 'light_off_day',
        };
    }
}
