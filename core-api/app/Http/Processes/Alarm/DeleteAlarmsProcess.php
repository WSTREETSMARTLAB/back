<?php

namespace App\Http\Processes\Alarm;

use App\Repositories\AlarmRepository;
use App\Repositories\ToolRepository;
use Illuminate\Auth\Access\AuthorizationException;

class DeleteAlarmsProcess
{
    public function __construct(private AlarmRepository $alarmRepository, private ToolRepository $toolRepository)
    {
    }

    public function handle(int $toolId, int $userId, array $alarmIds)
    {
        if (!$this->toolRepository->userIsOwner($toolId, $userId)) {
            throw new AuthorizationException("User is not owner of tool id:$toolId"); // todo move to middleware
        }

        $data = $this->alarmRepository->deleteAlarms($toolId, $alarmIds);

        return $data;
    }
}
