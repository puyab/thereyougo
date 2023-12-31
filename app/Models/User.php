<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\{HasName, FilamentUser};
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'email',
    'password',
    'role'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  public function profile(): HasOne
  {
    return $this->hasOne(Profile::class);
  }

  public function canAccessPanel(Panel $panel): bool
  {
    return true || in_array($this->role, ['super_admin', 'admin']);
  }

  public function getFilamentName(): string
  {
    return $this->profile->first_name . ' ' . $this->profile->last_name;
  }

  public function reset_password_requests(): HasMany
  {
    return $this->hasMany(ResetPasswordRequest::class);
  }

  public static function boot()
  {
    parent::boot();
  }

}
