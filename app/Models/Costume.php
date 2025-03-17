<?php

namespace App\Models;

use App\Enum\CostumeTypeEnum;
use App\Enum\GenderEnum;
use App\Observers\CostumeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

#[ObservedBy([CostumeObserver::class])]
class Costume extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'period_id',
    'costumes_category_id',
    'size_id',
    'location_id',
    'img_url',
    'number',
    'name',
    'description',
    'condition',
    'gender',
    'type',
    'deposit',
    'is_to_be_repaired',
    'price'
  ];

  protected $casts = [
    'period_id' => 'integer',
    'costumes_category_id' => 'integer',
    'size_id' => 'integer',
    'location' => 'integer',
    'gender' => GenderEnum::class,
    'type' => CostumeTypeEnum::class,
    'is_to_be_repaired' => 'boolean',
  ];

  public function size(): BelongsTo
  {
    return $this->belongsTo(Size::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(CostumesCategory::class, 'costumes_category_id', 'id');
  }

  public function period(): BelongsTo
  {
    return $this->belongsTo(Period::class);
  }

  public function location(): BelongsTo
  {
    return $this->belongsTo(Location::class);
  }

  public function costumeHistories(): HasMany
  {
    return $this->hasMany(CostumeHistory::class);
  }

  public function currentCostumeHistory(): HasOne
  {
    return $this->hasOne(CostumeHistory::class)
      ->whereNull('returned_at');
  }

  public function inactiveCostumeHistories(): HasMany
  {
    return $this->costumeHistories()
      ->whereNotNull('returned_at');
  }

  public function associatedActor(): HasOneThrough
  {
    return $this->hasOneThrough(
      Actor::class,
      CostumeHistory::class,
      'costume_id',
      'id',
      'id',
      'actor_id'
    );
  }

  public function activeRepairHistories(): HasOne
  {
    return $this->hasOne(RepairHistory::class)
      ->where('deleted_at', null);
  }

  public function actors(): BelongsToMany
  {
    return $this->belongsToMany(Actor::class, 'costume_histories')
      ->withPivot(Schema::getColumnListing('costume_histories'))
      ->withTimestamps();
  }

  public function repairHistories(): HasMany
  {
    return $this->hasMany(RepairHistory::class);
  }

  public function historyActors(): BelongsToMany
  {
    return $this->belongsToMany(Actor::class, 'costume_histories')
      ->wherePivot('returned_at', '!=', null)
      ->withTimestamps();
  }

  public function activeActor(): BelongsToMany
  {
    return $this->belongsToMany(Actor::class, 'costume_histories')
      ->withPivot(Schema::getColumnListing('costume_histories'))
      ->wherePivot('returned_at', null)
      ->withTimestamps();
  }

  public function scopeCostumes($query)
  {
    return $query->where('type', CostumeTypeEnum::COSTUME);
  }

  public function scopeAccessories($query)
  {
    return $query->where('type', CostumeTypeEnum::ACCESSORY);
  }

  public function scopeIsNotToBeRepaired($query)
  {
    return $query->where('is_to_be_repaired', false);
  }
}
