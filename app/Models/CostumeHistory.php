<?php

namespace App\Models;

use App\Events\SetToBeRepairedCostumeEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $actor_id
 * @property $costume_id
 * @property $amount_deposit
 * @property $return_condition
 * @property $returned_at
 * @property $amount_returned_deposit
 * @property $is_to_be_repaired
 * @property $comments
 */
class CostumeHistory extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'costume_histories';

  protected $fillable = [
    'actor_id',
    'costume_id',
    'amount_deposit',
    'take_condition',
    'return_condition',
    'returned_at',
    'amount_returned_deposit',
    'is_to_be_repaired',
    'comments'
  ];

  protected $casts = [
    'returned_at' => 'date'
  ];

  /**
   * The "booted" method of the model.
   */
  protected static function booted(): void
  {
    static::updated(function (CostumeHistory $actorCostume) {
      SetToBeRepairedCostumeEvent::dispatch($actorCostume);
    });
  }

  public function actor(): BelongsTo
  {
    return $this->belongsTo(Actor::class);
  }

  public function costume(): BelongsTo
  {
    return $this->belongsTo(Costume::class);
  }
}
