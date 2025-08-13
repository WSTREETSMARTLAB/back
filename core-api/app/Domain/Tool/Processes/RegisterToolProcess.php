<?php

namespace App\Domain\Tool\Processes;

use App\Domain\Tool\Actions\SendToolVerificationCodeEmailAction;
use App\Domain\Tool\Repositories\ToolRepository;

class RegisterToolProcess
{
    public function __construct(private ToolRepository $repository, private SendToolVerificationCodeEmailAction $sendToolVerificationCodeAction)
    {
    }

    public function handle(int $id, array $data): void
    {
        $code = $this->generateSafeCode();

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
            'settings' => [
                'min_temp' => 10,
                'max_temp' => 30,
                'min_hum' => 30,
                'max_hum' => 90,
                'light_control_enabled' => false,
            ]
        ];

        $this->repository->createTool($payload);

        $this->sendToolVerificationCodeAction->handle($code);
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
