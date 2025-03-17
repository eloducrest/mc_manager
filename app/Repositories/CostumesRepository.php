<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Actor;
use App\Models\Costume;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CostumesRepository
{
  private Costume $costume;

  private ?Builder $query = null;

  private array $relations = [
    'size',
    'location',
    'category',
    'period',
  ];

  private bool $withTrashed = false;

  /**
   * @return $this
   */
  public function withTrashed(): self
  {
    $this->withTrashed = true;

    return $this;
  }

  /**
   * @param array $relations
   * @return $this
   */
  public function relations(array $relations): self
  {
    $this->relations = $relations;

    return $this;
  }

  /**
   * @param array $relations
   * @return $this
   */
  public function addRelations(array $relations): self
  {
    $this->relations = array_merge($this->relations, $relations);

    return $this;
  }

  /**
   * @param string $relation
   * @return $this
   */
  public function addRelation(string $relation): self
  {
    $this->relations[] = $relation;

    return $this;
  }

  /**
   * @param int $id
   * @return Actor|null
   */
  public function findById(int $id): ?Costume
  {
    $this->costume = $this->query()
      ->findOrFail($id);

    return $this->costume;
  }

  /**
   * @param Actor $actor
   * @return $this
   */
  public function setCostume(Costume $costume): self
  {
    $this->costume= $costume;

    return $this;
  }

  /**
   * @param array|null $relations
   * @return Actor
   */
  public function getCostume(): Costume
  {
    return $this->costume
      ->load($this->relations);
  }

  /**
   * @param array $data
   * @return Costume
   */
  public function storeCostume(array $data): Costume
  {
    return Costume::create($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateCostume(array $data): bool
  {
    return $this->costume->update($data);
  }

  /**
   * @return bool
   */
  public function destroy(): bool
  {
    return $this->costume->delete();
  }

  /**
   * @param array $filters
   * @return $this
   */
  public function filters(array $filters): self
  {
    if (isset($filters['periods'])) {
      $this->query()->whereIn('period_id', $filters['periods']);
    }

    if (isset($filters['sizes'])) {
      $this->query()->whereHas('size', function($costumes) use ($filters) {
        $costumes->whereIn('size_id', $filters['sizes']);
      });
    }

    if (isset($filters['categories'])) {
      $this->query()->whereIn('costumes_category_id', $filters['categories']);
    }

    if (isset($filters['genders'])) {
      $this->query()->whereIn('gender', $filters['genders']);
    }

    if (isset($filters['state'])) {
      $this->query()->where(function($query) use ($filters) {
        $query->when($filters['state'] === 'repaired', function($query) {
          $query->where('is_to_be_repaired', true);
        })->when($filters['state'] === 'unavailable', function($query) {
          $query->has('currentCostumeHistory');
        });
      });
    }

    return $this;
  }

  /**
   * @param array $relations
   * @return $this
   */
  public function withRelationships(array $relations)
  {
    $this->relations = $relations;
    return $this;
  }

  /**
   * @param array $relations
   * @return $this
   */
  public function doesntHave(array $relations): self
  {
    foreach ($relations as $relation) {
      $this->query()->doesntHave($relation);
    }

    return $this;
  }

  public function query(): Builder
  {
    if (! $this->query) {
      $this->query = Costume::withTrashed($this->withTrashed)
        ->with($this->relations);
    }

    return $this->query;
    //return $this->model->query()->with($this->relationships)->costumes();
  }
}
