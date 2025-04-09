<?php

namespace App\Repositories;

class AlarmRepository extends Repository
{
    public function registerAlarmStart(int $toolId, $alarm): void
    {
        // implement saving alarm to db
        // return alarm id
    }

    public function registerAlarmEnd(int $toolId, int $alarmId): void
    {
        // implement update alarm signal with end date
    }
}
