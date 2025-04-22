<?php

namespace App\Http\Processes\Tool;

use App\Repositories\ToolRepository;

class RegisterToolProcess
{
    public function __construct(private ToolRepository $repository)
    {
    }

    public function handle(int $id, array $data): string
    {
        $code = $this->generateSafeCode();

        // hash code
        // create token

        $payload = [
            'type' => $data['type'],
            'user_id' => $id,
            'company_id' => null,
            'is_active' => true,
            'code' => $code,
            'activated_at' => now(),
            'name' => $data['name'],
            'location_note' => null,
            'last_online_at' => now(),
            'firmware_version' => 'ARDUINO 2.0', // remove hardcode
            'settings' => []
        ];

        $this->repository->createTool($payload);

        return $code;
    }

    private function generateSafeCode(): string
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';

        for ($i = 0; $i < 8; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return substr(chunk_split($code, 4, '-'), 0, -1);
    }
}
