<?php

namespace App\Domain\Tool\Models;

use App\Domain\Company\Models\Company;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'company_id',
        'active',
        'code',
        'activated_at',
        'name',
        'location_note',
        'last_online_at',
        'firmware_version',
        'settings',
    ];

    protected $casts = [
        'active' => 'boolean',
        'activated_at' => 'datetime',
        'last_online_at' => 'datetime',
        'settings' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
