<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\Uid\Ulid;

class Profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUlids;

    protected $fillable = [
        'role',
        'company',
        'telephone',
        'location',
        'accommodation_type',
        'rooms',
        'sleep_rooms',
        'high_speed_wifi',
        'features',
        'first_name',
        'last_name',
        'linkedin',
        'user_id',
        'status',
        'referral_code',
        'referred_from'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function(Profile $model) {
            $model->referral_code = Ulid::generate();
            return $model;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('avatar')->optimize()->withResponsiveImages()->queued();
        $this->addMediaConversion('gallery')->optimize()->withResponsiveImages()->queued();
    }
}
