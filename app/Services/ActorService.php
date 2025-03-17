<?php

namespace App\Services;

use App\Models\Actor;
use App\Repositories\ActorsRepository;
use Illuminate\Database\Eloquent\Collection;

class ActorService
{
  private ActorsRepository $repository;

  public function __construct(ActorsRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * @return Collection
   */
  public function getActorsWithCurrentCostumesAndHistory(): Collection
  {
    return $this->repository
      ->addRelation('currentCostumes.currentCostumeHistory')
      ->query()
      ->orderByDesc('created_at')
      ->get();
  }

  /**
   * @param Actor $actor
   * @return Actor
   */
  public function getActorForView(Actor $actor): Actor
  {
    return $this->repository
      ->setActor($actor)
      ->getActor([
        'costumes',
        'currentCostumes.currentCostumeHistory',
        'pastCostumeHistories.costume'
      ]);
  }

  /**
   * @param int $id
   * @return Actor|null
   */
  public function findActor(int $id): ?Actor
  {
    return $this->repository->findById($id);
  }

  /**
   * @param array $data
   * @return Actor
   */
  public function storeActor(array $data): Actor
  {
    $data['is_volunteer'] = $data['is_volunteer'] ?? false;

    return $this->repository->storeActor($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateActor(array $data): bool
  {
    $actor = $this->findActor($data['id']);
    $data['is_volunteer'] = $data['is_volunteer'] ?? false;

    return $this->repository
      ->setActor($actor)
      ->updateActor($data);
  }

  /**
   * @param int $id
   * @return bool
   */
  public function deleteActor(int $id): bool
  {
    $actor = $this->findActor($id);

    return $this->repository
      ->setActor($actor)
      ->deleteActor();
  }

  /**
   * @param string $value
   * @param array $columns
   * @return Collection
   */
  public function searchActors(string $value, array $columns): Collection
  {
    return $this->repository
      ->query()
      ->whereAny($columns, 'like', "%{$value}%")
      ->get();
  }
}
