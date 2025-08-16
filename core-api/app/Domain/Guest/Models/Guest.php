<?php

namespace App\Domain\Guest\Models;

use App\Domain\Profile\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected static function newFactory()
    {
        return \Database\Factories\GuestFactory::new();
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
