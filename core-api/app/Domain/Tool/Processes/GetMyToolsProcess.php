<?php

namespace App\Domain\Tool\Processes;

use App\Domain\Tool\DTO\ToolDTO;
use App\Domain\Tool\Models\Tool;
use App\Repositories\ToolRepository;
use Illuminate\Support\Collection;

class GetMyToolsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $id): Collection
    {
        $tools = $this->repository->getToolsByUserId($id)
            ->map(function (Tool $tool){
                $toolDTO = new ToolDTO($tool);

                return [
                    'id' => $toolDTO->id(),
                    'name' => $toolDTO->name(),
                    'type' => $toolDTO->type(),
                    'active' => $toolDTO->active(),
                    'last_online' => $toolDTO->lastOnline(),
                ];
            });

        return $tools;
    }
}
