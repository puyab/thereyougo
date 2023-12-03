<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

class ResetPasswordRequest extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'code',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function (ResetPasswordRequest $model) {
            $model->id = Ulid::generate(now());
            $model->code = Ulid::generate(now());
            return $model;
        });
    }
}
