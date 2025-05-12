<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolSettingsDTO;
use App\Repositories\ToolRepository;
use Illuminate\Auth\Access\AuthorizationException;

class SetToolSettingsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $toolId, int $userId, array $data): ToolSettingsDTO
    {
        if (!$this->repository->userIsOwner($toolId, $userId)) {
            throw new AuthorizationException("User is not owner of tool id:$toolId");
        }

        $response = $this->repository->updateToolSetting($toolId, $data);

        return new ToolSettingsDTO($response);
    }
}
