<?php

namespace App\Http\Actions;

use App\Enum\Alarm;

class AnalyzeTemperature extends AnalyzeAction
{
    public function handle(int $value): void
    {
        if ($this->settings['min_temp'] !== null && $value < $this->settings['min_temp']) {
            $this->startAlarm(Alarm::TEMP_LOW->name);
        } else {
            $this->resolveAlarm(Alarm::TEMP_LOW->name);
        }

        if ($this->settings['max_temp'] !== null && $value > $this->settings['max_temp']) {
            $this->startAlarm(Alarm::TEMP_HIGH->name);
        } else {
            $this->resolveAlarm(Alarm::TEMP_HIGH->name);
        }
    }
}
