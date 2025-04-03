<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'phone',
        'phone_verified_at',
        'tax_id',
        'activities',
        'email',
        'email_verified_at',
        'active',
        'owner_user_id',
        'logo',
        'description',
        'website',
        'telegram',
        'facebook',
        'linkedin',
        'twitter',
        'settings'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'active' => 'boolean',
        'activities' => 'array',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class, 'company_id');
    }
}
