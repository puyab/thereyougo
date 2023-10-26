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
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'role',
        'company',
        'telephone',
        'location',
        'latitude',
        'longitude',
        'accommodation_type',
        'bedrooms',
        'sleep_rooms',
        'high_speed_wifi',
        'features',
        'first_name',
        'last_name',
        'linkedin',
        'user_id',
        'status',
        'referral_code',
        'referred_from',
        'images',
        'details_submitted',
        'features_submitted',
        'pictures_submitted',
        'referral_count'
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'high_speed_wifi' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Profile $model) {
            $model->referral_code = Ulid::generate();
            if(!$model->features)
              $model->features = [];
            return $model;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function registerMediaConversions(Media $media = null): void
   {
     foreach(['avatar', 'pic_1', 'pic_2', 'pic_3'] as $collection) {
       $this->addMediaConversion($collection)->withResponsiveImages()->optimize()->queued()->performOnCollections($collection);
     }
   }

   public function canAccessProfile(): bool {
      return $this->details_submitted;
   }
}
