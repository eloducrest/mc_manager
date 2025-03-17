<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Actor;
use App\Models\Costume;
use App\Models\CostumeHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CostumeHistoriesRepository
{
  private CostumeHistory $costumeHistory;

  private ?Builder $query = null;

  private array $relations = [];

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
  public function findById(int $id): ?CostumeHistory
  {
    $this->costumeHistory = $this->query()
      ->find($id);

    return $this->costumeHistory;
  }

  /**
   * @param Actor $actor
   * @return $this
   */
  public function setCostume(CostumeHistory $costumeHistory): self
  {
    $this->costumeHistory= $costumeHistory;

    return $this;
  }

  /**
   * @param array|null $relations
   * @return Actor
   */
  public function getCostume(): CostumeHistory
  {
    return $this->costumeHistory
      ->load($this->relations);
  }

  /**
   * @param array $costumes
   * @return Collection
   */
  public function createCostumeHistories(Actor $actor, array $costumes): Collection
  {
    return $actor->costumeHistories()->createMany($costumes);
  }

  public function updateCostumeHistory(Costume $costume, array $data): bool
  {
    $costume->is_to_be_repaired = $data['is_to_be_repaired'];
    $costume->save();

    return $costume->currentCostumeHistory->update([
      'amount_returned_deposit' => $data['amount_returned_deposit'],
      'return_condition' => $data['return_condition'],
      'returned_at' => now(),
      'is_to_be_repaired' => $data['is_to_be_repaired'],
      'comments' => $data['comments'] ?? null
    ]);
  }

  public function query(): Builder
  {
    if (! $this->query) {
      $this->query = CostumeHistory::withTrashed($this->withTrashed)
        ->with($this->relations);
    }

    return $this->query;
  }

}
