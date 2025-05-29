<?php

namespace App\Http\Processes\Alarm;

use App\Repositories\AlarmRepository;

class DeleteAlarmsProcess
{
    public function __construct(private AlarmRepository $alarmRepository)
    {
    }

    public function handle(int $toolId, int $userId,  array $ids)
    {

    }
}
