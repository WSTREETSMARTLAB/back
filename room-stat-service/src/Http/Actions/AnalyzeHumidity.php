<?php

namespace App\Http\Actions;

use App\Enum\Alarm;

class AnalyzeHumidity extends AnalyzeAction
{
    public function handle(float $value): void
    {
        if ($this->settings['min_hum'] !== null && $value < $this->settings['min_hum']) {
            $this->startAlarm(Alarm::HUM_LOW->code(), $value);
        } else {
            $this->resolveAlarm(Alarm::HUM_LOW->code());
        }

        if ($this->settings['max_hum'] !== null && $value > $this->settings['max_hum']) {
            $this->startAlarm(Alarm::HUM_HIGH->code(), $value);
        } else {
            $this->resolveAlarm(Alarm::HUM_HIGH->code());
        }
    }
}
