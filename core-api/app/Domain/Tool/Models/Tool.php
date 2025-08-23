<?php

namespace App\Domain\Tool\Models;

use App\Domain\Profile\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'profile_id',
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

    protected static function newFactory()
    {
        return \Database\Factories\ToolFactory::new();
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(
            Profile::class,
            'profile_id',
            'id',
            'profile'
        );
    }
}
