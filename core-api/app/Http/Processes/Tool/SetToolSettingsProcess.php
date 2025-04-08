<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolSettingsDTO;
use App\Repositories\ToolRepository;

class SetToolSettingsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $toolId, int $userId, array $data): ToolSettingsDTO
    {
        $response = $this->repository->updateToolSetting($toolId, $data);

        return new ToolSettingsDTO($response);
    }
}
