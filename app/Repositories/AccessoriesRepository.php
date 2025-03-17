<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Costume;
use Illuminate\Database\Eloquent\Builder;

class AccessoriesRepository
{
  public function __construct(
    protected Costume $model,
    protected array $relationships = []
  ){}

  public function filters(array $filters)
  {
    $periods = $filters['periods'] ?? null;
    $sizes = $filters['sizes'] ?? null;
    $categories = $filters['categories'] ?? null;
    $genders = $filters['genders'] ?? null;

    $costumes = $this->query();

    if ($periods) {
      $costumes->whereIn('period_id', $this->setFilters($periods, 'id'));
    }

    if ($sizes) {
      $costumes->whereHas('size', function($costumes) use ($sizes) {
        $costumes->whereIn('size_id', $this->setFilters($sizes, 'id'));
      });
    }

    if ($categories) {
      $costumes->whereIn('costumes_category_id', $this->setFilters($categories, 'id'));
    }

    if ($genders) {
      $costumes->whereIn('gender', $genders);
    }

    return $costumes;
  }

  public function withRelationships(array $relationships)
  {
    $this->relationships = $relationships;
    return $this;
  }

  public function query()
  {
    return $this->model->query()->with($this->relationships)->accessories();
  }

  protected function setFilters(array $filters, string $key): array
  {
    $array =[];
    foreach ($filters as $index => $filter) {
      $array[] = $filter[$key];
    }
    return $array;
  }
}
