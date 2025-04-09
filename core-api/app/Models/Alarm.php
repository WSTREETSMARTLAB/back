<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alarm extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'tool_id',
        'value',
        'start',
        'end',
        'resolved'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'resolved' => 'boolean',
        'type' => \App\Enums\Alarm::class,
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }
}
