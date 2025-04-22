<?php

namespace App\Http\Processes\Tool;

use App\Models\Tool;
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

        $toolAccessData = DB::table('tool_access_tokens')
            ->where('code', $data['code'])
            ->first();

        if (!$toolAccessData || now()->gt($toolAccessData->expires_at)) {
            // todo remove old tokens
            $toolAccessData = $this->authorizeTool($data['code']);
        }

        return $toolAccessData->token;
    }

    private function authorizeTool(string $code)
    {
        $token = Str::random(64);

        $tokenId = DB::table('tool_access_tokens')->insertGetId([
            'code' => $code,
            'token' => $token,
            'issued_at' => now(),
            'expires_at' => now()->addSeconds(self::TOKEN_EXPIRATION_TIME),
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::table('tool_access_tokens')
            ->where('id', $tokenId)
            ->first();
    }
}
