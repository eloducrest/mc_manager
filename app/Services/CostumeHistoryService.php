<?php

namespace App\Services;

use App\Repositories\ActorsRepository;
use App\Repositories\CostumeHistoriesRepository;
use App\Repositories\CostumesRepository;
use Illuminate\Database\Eloquent\Collection;

class CostumeHistoryService
{
  private ActorsRepository $actorsRepository;

  private CostumesRepository $costumesRepository;

  private CostumeHistoriesRepository $costumeHistoriesRepository;

  public function __construct(
    ActorsRepository $actorsRepository,
    CostumesRepository $costumesRepository,
    CostumeHistoriesRepository $costumeHistoriesRepository
  )
  {
    $this->actorsRepository   = $actorsRepository;
    $this->costumesRepository = $costumesRepository;
    $this->costumeHistoriesRepository = $costumeHistoriesRepository;
  }

  public function associateCostumesToActor(int $actorId, array $costumes): Collection
  {
    $actor = $this->actorsRepository
      ->findById($actorId);

    return $this->costumeHistoriesRepository
      ->createCostumeHistories($actor, $costumes);
  }

  public function dissociateCostumeToActor(array $dataReturn): bool
  {
    $costume = $this->costumesRepository
      ->findById($dataReturn['costume_id']);

    $this->costumesRepository
      ->updateCostume(['condition' => $dataReturn['return_condition']]);

    return $this->costumeHistoriesRepository->updateCostumeHistory($costume, $dataReturn);
  }
}
