<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostumesCategory extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'label',
  ];

  public function costumes(): HasMany
  {
    return $this->hasMany(Costume::class);
  }
}
