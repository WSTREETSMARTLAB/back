<?php

namespace App\Models;

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
        'room_id',
        'is_active',
        'code',
        'activated_at',
        'name',
        'location_note',
        'last_online_at',
        'firmware_version',
        'meta',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'activated_at' => 'datetime',
        'last_online_at' => 'datetime',
        'meta' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

//    public function room(): BelongsTo
//    {
//        return $this->belongsTo(Room::class);
//    }
}
