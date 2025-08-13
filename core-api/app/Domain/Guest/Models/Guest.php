<?php

namespace App\Domain\Guest\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'ip',
        'user_agent',
        'accept_language',
        'referer',
        'host',
        'path',
        'method',
        'query',
    ];
}
