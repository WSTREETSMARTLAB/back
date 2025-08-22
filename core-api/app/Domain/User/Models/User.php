<?php

namespace App\Domain\User\Models;

use App\Domain\Company\Models\Company;
use App\Domain\Profile\Models\Profile;
use App\Domain\Tool\Models\Tool;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'profile_id',
        'username',
        'location',
        'phone',
        'phone_verified_at',
        'company_id',
        'avatar',
        'bio',
        'website',
        'telegram',
        'linkedin',
        'instagram',
        'facebook',
        'twitter',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'settings' => 'array',
        'has_subscription' => 'boolean',
        'subscription_expires_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\ProfileFactory::new();
    }

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'owner');
    }

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
