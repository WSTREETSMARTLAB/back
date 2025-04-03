<?php

namespace App\Http\Processes\Tool;

class ResolveUserToolProcess
{
    public function __construct(
        private FetchUserRoomStatToolsProcess $fetchUserRoomStatToolsProcess,
    )
    {
    }

    public function handle(int $id, string $type)
    {
        return match ($type) {
            'room_stat' => $this->fetchUserRoomStatToolsProcess->handle($id),
        };
    }
}
