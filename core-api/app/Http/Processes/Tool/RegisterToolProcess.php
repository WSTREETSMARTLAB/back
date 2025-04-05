<?php

namespace App\Http\Processes\Tool;

use App\DTO\Tool\ToolDTO;
use App\Repositories\ToolRepository;

class RegisterToolProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $id, array $data): ToolDTO
    {
        $code = '12345JHJOLJK'; // generate code

        // hash password + code

        $payload = [
            'type' => $data['type'],
            'user_id' => $id,
            'company_id' => null,
            'is_active' => true,
            'code' => $code,
            'activated_at' => now(),
            'name' => 'user_'. $id. '_',
            'location_note' => null,
            'last_online_at' => now(),
            'firmware_version' => 'ARDUINO 2.0', // remove hardcode
            'meta' => []
        ];

        $tool = $this->repository->createTool($payload);

        return new ToolDTO($tool->toArray());
    }
}
