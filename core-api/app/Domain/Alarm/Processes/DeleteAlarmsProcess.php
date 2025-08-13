<?php

namespace App\Domain\Alarm\Processes;

use App\Domain\Alarm\Repositories\AlarmRepository;
use App\Domain\Tool\Repositories\ToolRepository;
use Illuminate\Auth\Access\AuthorizationException;

class DeleteAlarmsProcess
{
    public function __construct(private AlarmRepository $alarmRepository, private ToolRepository $toolRepository)
    {
    }

    public function handle(int $toolId, int $userId, array $alarmIds): void
    {
        if (!$this->toolRepository->userIsOwner($toolId, $userId)) {
            throw new AuthorizationException("User is not owner of tool id:$toolId"); // todo move to middleware
        }

        $this->alarmRepository->deleteAlarms($toolId, $alarmIds);
    }
}
