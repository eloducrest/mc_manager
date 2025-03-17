<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $tel
 * @property string $address
 * @property string $zip_code
 * @property string $city
 * @property boolean $is_volunteer
 * @property string $size
 * @property string $shoe_size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Collection $costumeHistories
 * @property Collection $costumes
 */
class Actor extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'lastname',
    'firstname',
    'email',
    'tel',
    'address',
    'zip_code',
    'city',
    'is_volunteer',
    'size',
    'shoe_size',
  ];

  protected $casts = [
    'zip_code' => 'string',
    'is_volunteer' => 'boolean',
  ];

  public function costumeHistories(): HasMany
  {
    return $this->hasMany(CostumeHistory::class);
  }

  public function pastCostumeHistories(): HasMany
  {
    return $this->costumeHistories()
      ->whereNotNull('returned_at');
  }

  public function currentCostumes(): HasManyThrough
  {
    return $this->costumes()
      ->whereNull('costume_histories.returned_at');
  }

  public function pastCostumes(): HasManyThrough
  {
    return $this->costumes()
      ->whereNotNull('costume_histories.returned_at');
  }

  public function costumes(): HasManyThrough
  {
    return $this->hasManyThrough(
      Costume::class,
      CostumeHistory::class,
      'actor_id',
      'id',
      'id',
      'costume_id'
    )->with(['location', 'category', 'period', 'size']);
  }
}
