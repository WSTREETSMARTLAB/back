<?php

namespace App\Http\Processes\Tool;

class ResolveUserToolProcess
{
    public function __construct(
        private FetchUserRoomStatToolsProcess $fetchUserRoomStatToolsProcess,
    )
    {
    }

    public function handle(int $id, string $type = "")
    {
//        if ($type) {
//            return match ($type) {
//                'room-stat' => $this->fetchUserRoomStatToolsProcess->handle($id),
//            };
//        }

        return $this->fetchUserRoomStatToolsProcess->handle($id);
    }
}
