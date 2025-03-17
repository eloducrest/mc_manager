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

class Location extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'label',
    'description',
    'code',
  ];

  public function costumes(): HasMany
  {
    return $this->hasMany(Costume::class);
  }
}
