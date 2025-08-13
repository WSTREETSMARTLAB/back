<?php

namespace App\Domain\Tool\Processes;

use App\Domain\Tool\DTO\ToolSettingsDTO;
use App\Domain\Tool\Repositories\ToolRepository;
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
