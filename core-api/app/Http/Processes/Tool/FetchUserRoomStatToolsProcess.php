<?php

namespace App\Http\Processes\Tool;

use App\Repositories\ToolRepository;

class FetchUserRoomStatToolsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $id)
    {
        return $this->repository->getRoomStatToolsByUserId($id);
    }
}
