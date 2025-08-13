<?php

namespace App\Domain\Guest\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class GuestDTO extends DataTransferObject
{
    public readonly string $ip;
    public readonly ?string $user_agent;
    public readonly ?string $accept_language;
    public readonly ?string $referer;
    public readonly ?string $host;
    public readonly ?string $path;
    public readonly ?string $method;
    public readonly ?string $query;
}
