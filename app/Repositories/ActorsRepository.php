<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Builder;

class ActorsRepository
{
  private Actor $actor;

  private ?Builder $query = null;

  private array $relations = [];

  public bool $withTrashed = false;

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
  public function findById(int $id): ?Actor
  {
    $this->actor = $this->query()
      ->findOrFail($id);

    return $this->actor;
  }

  /**
   * @param Actor $actor
   * @return $this
   */
  public function setActor(Actor $actor): self
  {
    $this->actor = $actor;

    return $this;
  }

  /**
   * @param array|null $relations
   * @return Actor
   */
  public function getActor(?array $relations = null): Actor
  {
    if ($relations) {
      return $this->actor
        ->load($relations);
    }

    return $this->actor;
  }

  /**
   * @param array $data
   * @return Actor
   */
  public function storeActor(array $data): Actor
  {
    return Actor::create($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateActor(array $data): bool
  {
    return $this->actor->update($data);
  }

  /**
   * @return bool
   */
  public function deleteActor(): bool
  {
    return $this->actor->delete();
  }

  /**
   * @return Builder
   */
  public function query(): Builder
  {
    if (! $this->query) {
      $this->query = Actor::withTrashed($this->withTrashed)
        ->with($this->relations);
    }

    return $this->query;
  }
}
