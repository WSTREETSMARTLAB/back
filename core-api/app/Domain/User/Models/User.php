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
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
//        'email',
//        'email_verification_code',
//        'email_verification_code_expires_at',
//        'email_verified_at',
//        'password',
        'location',
        'phone',
        'phone_verified_at',
        'company_id',
        'role',
//        'active',
//        'last_login',
        'avatar',
        'bio',
        'website',
        'telegram',
        'linkedin',
        'instagram',
        'facebook',
        'twitter',
        'settings',
        'subscription_plan',
        'subscription_expires_at',
    ];

//    /**
//     * The attributes that should be hidden for serialization.
//     *
//     * @var array<int, string>
//     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
//        'email_verification_code',
//        'email_verification_code_expires_at',
        'phone_verified_at' => 'datetime',
//        'last_login' => 'datetime',
//        'password' => 'hashed',
//        'active' => 'boolean',
        'settings' => 'array',
        'has_subscription' => 'boolean',
        'subscription_expires_at' => 'datetime',
    ];

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'owner');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
