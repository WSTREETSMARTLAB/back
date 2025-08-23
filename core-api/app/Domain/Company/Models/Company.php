<?php

namespace App\Domain\Company\Models;

use App\Domain\Profile\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        'activities' => 'array',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CompanyFactory::new();
    }

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'owner');
    }
}
