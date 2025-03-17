<?php

namespace App\Models;

use App\Events\SetIsRepairedCostumeEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairHistory extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'costume_id',
    'comments',
    'condition_before_repair',
    'condition_after_repair',
    'repair_comment',
    'resolved_comment'
  ];

  /**
   * The "booted" method of the model.
   */
  protected static function booted(): void
  {
    static::updated(function (RepairHistory $repairHistory) {
      //SetIsRepairedCostumeEvent::dispatch($repairHistory);
    });
  }

  public function costume(): BelongsTo
  {
    return $this->belongsTo(Costume::class);
  }
}
