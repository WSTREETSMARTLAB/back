<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolSettingsDTO;
use App\Repositories\ToolRepository;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetToolSettingsProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $toolId, int $userId): ToolSettingsDTO
    {
        if (!$this->repository->userIsOwner($toolId, $userId)) {
            throw new AccessDeniedHttpException();
        }

        $response = $this->repository->getToolSettingsById($toolId);

        return new ToolSettingsDTO($response);
    }
}
