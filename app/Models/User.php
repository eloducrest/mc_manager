<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

/**
 * @property $lastname
 * @property $firstname
 * @property $role
 * @property $email
 * @property $tel
 * @property $img_profile
 * @property $password
 */
class User extends Authenticatable
{
  use HasFactory, Notifiable, Searchable, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'lastname',
    'firstname',
    'role',
    'function',
    'email',
    'tel',
    'img_profile',
    'password',
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

  public static function boot(): void
  {
    parent::boot();
    static::creating(fn (User $user) =>
      $user->img_profile = 'https://ui-avatars.com/api/?name=' . $user->firstname.$user->lastname .'background=random&rounded=true',
    );
  }

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Determine if the user is an admin
   * @return bool
   */
  public function isAdmin(): bool
  {
    return $this->role === 'admin';
  }
}
