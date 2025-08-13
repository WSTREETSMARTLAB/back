<?php

namespace App\Domain\Guest\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

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
