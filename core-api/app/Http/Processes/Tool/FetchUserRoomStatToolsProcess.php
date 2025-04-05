<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolDTO;
use App\Models\Tool;
use App\Repositories\ToolRepository;
use Illuminate\Support\Collection;

class FetchUserRoomStatToolsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $id): Collection
    {
        $tools = $this->repository->getRoomStatToolsByUserId($id)
            ->map(fn (Tool $tool) => (new ToolDTO($tool))
                ->toArray());

        return $tools;
    }
}
