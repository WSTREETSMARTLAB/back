<?php

namespace App\Http\Processes\Alarm;

use App\Repositories\AlarmRepository;
use App\Repositories\ToolRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class GetAlarmListProcess
{
    public function __construct(private ToolRepository $toolRepository, private AlarmRepository $alarmRepository)
    {
    }

    public function handle(int $toolId, int $userId): Collection
    {


        if (!$this->toolRepository->userIsOwner($toolId, $userId)) {
            throw new AuthorizationException("User is not owner of tool id:$toolId");
        }

        $alarms = $this->alarmRepository->forTool($toolId);

        return $alarms;
    }
}
