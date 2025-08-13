<?php

namespace App\Domain\Tool\Processes;

use App\Repositories\ToolRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetToolPreferencesProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $userId, int $toolId): array
    {
        if (!$this->repository->userIsOwner($toolId, $userId)) {
            throw new AccessDeniedHttpException();
        }

        $tool = $this->repository->getToolByUserId($userId, $toolId);
        $toolAccessData = DB::table('tool_access_tokens')->where('code', $tool->code)->first();

        return [
            'name' => $tool->name,
            'type' => $tool->type,
            'token' => $toolAccessData->token,
        ];
    }
}
