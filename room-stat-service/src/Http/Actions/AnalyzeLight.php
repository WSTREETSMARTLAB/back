<?php

namespace App\Http\Actions;

use App\Enum\Alarm;

class AnalyzeLight extends AnalyzeAction
{
    public function handle(int $value): void
    {
        $currentTime = (new \DateTime());
        $isDay = $currentTime >= $this->settings['day_start'] && $currentTime <= $this->settings['day_end'];

        if ($isDay && $value < $this->settings['light_day_threshold']) {
            $this->startAlarm(Alarm::LIGHT_OFF_DAY->code(), $value);
        } else {
            $this->resolveAlarm(Alarm::LIGHT_OFF_DAY->code());
        }

        if (!$isDay && $value > $this->settings['light_night_threshold']) {
            $this->startAlarm(Alarm::LIGHT_ON_NIGHT->code(), $value);
        } else {
            $this->resolveAlarm(Alarm::LIGHT_ON_NIGHT->code());
        }
    }
}
