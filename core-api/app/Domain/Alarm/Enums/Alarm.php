<?php

namespace App\Domain\Alarm\Enums;

enum Alarm: string
{
    case TEMP_LOW = 'temp_low';
    case TEMP_HIGH = 'temp_high';
    case HUM_LOW = 'hum_low';
    case HUM_HIGH = 'hum_high';
    case LIGHT_ON_NIGHT = 'light_on_night';
    case LIGHT_OFF_DAY = 'light_off_day';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function message(): string
    {
        return match($this) {
            self::TEMP_LOW => 'Detected Low Temperature level on area',
            self::TEMP_HIGH => 'Detected High Temperature level on area',
            self::HUM_LOW => 'Detected Low Humidity level on area',
            self::HUM_HIGH => 'Detected High Humidity level on area',
            self::LIGHT_ON_NIGHT => 'Detected High Light level on night period',
            self::LIGHT_OFF_DAY => 'Detected Low Light level in the day period',
        };
    }
}
