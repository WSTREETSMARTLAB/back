<?php

namespace App\Http\Actions;

use App\Enum\Alarm;

class AnalyzeLight extends AnalyzeAction
{
    public function handle(int $value): void
    {
        if ($this->settings['light_control_enabled']) {
            $timezone = new \DateTimeZone($this->settings['timezone'] ?? 'UTC');
            $currentTime = new \DateTime('now', new \DateTimeZone($this->settings['timezone'] ?? 'UTC'));

            $dayStart = \DateTime::createFromFormat('H:i', $this->settings['day_start'], $timezone);
            $interval = new \DateInterval("PT{$this->settings['day_period']}H");
            $dayEnd = clone $dayStart;
            $dayEnd->add($interval);
            $isDay = $currentTime >= $dayStart && $currentTime <= $dayEnd;

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
}
