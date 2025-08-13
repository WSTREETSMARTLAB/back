<?php

namespace App\Domain\Alarm\Processes;

use App\Domain\Alarm\Repositories\AlarmRepository;
use App\Domain\Tool\Repositories\ToolRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAlarmListProcess
{
    public function __construct(private ToolRepository $toolRepository, private AlarmRepository $alarmRepository)
    {
    }

    public function handle(int $toolId, int $userId, int $perPage): LengthAwarePaginator
    {
        if (!$this->toolRepository->userIsOwner($toolId, $userId)) {
            throw new AuthorizationException("User is not owner of tool id:$toolId"); // todo move to middleware
        }

        $alarms = $this->alarmRepository->forTool($toolId, $perPage);

        return $alarms;
    }
}
