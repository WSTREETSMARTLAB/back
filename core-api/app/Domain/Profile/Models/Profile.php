<?php

namespace App\Domain\Profile\Models;

use App\Domain\Guest\Models\Guest;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasFactory;
    use HasApiTokens;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'email_verification_code',
        'email_verification_code_expires_at',
        'email_verified_at',
        'active',
        'last_login',
        'guest_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'email_verification_code_expires_at' => 'datetime',
        'active' => 'boolean',
        'last_login' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\ProfileFactory::new();
    }

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}
