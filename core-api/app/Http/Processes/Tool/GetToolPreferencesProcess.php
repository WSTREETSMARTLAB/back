<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolDTO;
use App\Repositories\ToolRepository;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetToolPreferencesProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $userId, int $toolId): ToolDTO
    {
        if (!$this->repository->userIsOwner($toolId, $userId)) {
            throw new AccessDeniedHttpException();
        }

        $tool = $this->repository->getToolByUserId($userId, $toolId);

        return new ToolDTO($tool);
    }
}
