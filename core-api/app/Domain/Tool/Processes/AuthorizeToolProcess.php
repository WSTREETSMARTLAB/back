<?php

namespace App\Domain\Tool\Processes;

use App\Domain\Tool\Models\Tool;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthorizeToolProcess
{
    private const TOKEN_EXPIRATION_TIME = 3600 * 24 * 30;

    public function handle(array $data)
    {
        $tool = Tool::where('code', $data['code'])->first();

        if (!$tool) {
            throw new AuthorizationException("Tool Unauthorized");
        }

        $token = $this->authorizeTool($data['code']);

        return $token;
    }

    private function authorizeTool(string $code): string
    {
        $token = Str::random(64);
        $query = DB::table('tool_access_tokens');

        $data = [
            'code' => $code,
            'token' => $token,
            'issued_at' => now(),
            'expires_at' => now()->addSeconds(self::TOKEN_EXPIRATION_TIME),
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (!$this->exists($code)) {
            $query->insert($data);
        } else {
            $query->update($data);
        }

        return $token;
    }

    private function exists(string $code): bool
    {
        return DB::table('tool_access_tokens')
            ->where('code', $code)
            ->exists();
    }
}
