<?php

namespace App\Services;

use App\Http\Controllers\Traits\GlobalControllerTrait;
use App\Models\Actor;
use App\Models\Costume;
use App\Repositories\ActorsRepository;
use App\Repositories\CostumesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostumeService
{
  use GlobalControllerTrait;

  private ActorsRepository $actorsRepository;

  private CostumesRepository $costumesRepository;

  public function __construct(CostumesRepository $costumesRepository, ActorsRepository $actorsRepository)
  {
    $this->actorsRepository = $actorsRepository;
    $this->costumesRepository = $costumesRepository;
  }

  /**
   * @param array $filters
   * @return Collection
   */
  public function getCostumesForIndex(): Collection
  {
    return $this->costumesRepository
      ->addRelations(['currentCostumeHistory', 'associatedActor'])
      ->query()
      ->orderByDesc('created_at')
      ->get();
  }

  public function getFilteredCostumes(array $filters): Collection
  {
    return $this->costumesRepository
      ->addRelations(['currentCostumeHistory', 'associatedActor'])
      ->filters($this->formattedFilters($filters))
      ->query()
      ->orderByDesc('created_at')
      ->get();
  }

  /**
   * @param Actor $actor
   * @return Actor
   */
  public function getCostumeForView(Costume $costume): Costume
  {
    return $this->costumesRepository
      ->setCostume($costume)
      ->relations([
        'size',
        'location',
        'category',
        'period',
        'actors',
        'currentCostumeHistory.actor',
        'inactiveCostumeHistories' => function (HasMany $query) {
          $query->with('actor')
            ->orderBy('updated_at', 'desc');
        }
      ])
      ->getCostume();
  }

  /**
   * @param int $id
   * @return Actor|null
   */
  public function findCostume(int $id): ?Costume
  {
    return $this->costumesRepository->findById($id);
  }

  /**
   * @param array $data
   * @return Actor
   */
  public function storeCostume(array $data): Costume
  {
    $data['is_to_be_repaired'] = $data['is_to_be_repaired'] ?? false;

    $data['img_url'] = $this->setImageUrl(
      $data['img_url'],
      $data['name'] . '-' . now()->timestamp
    );

    return $this->costumesRepository->storeCostume($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateCostume(array $data): bool
  {
    $costume = $this->findCostume($data['id']);

    $data['is_to_be_repaired'] = $data['is_to_be_repaired'] ?? false;

    $data['img_url'] = $this->setImageUrl(
      $data['img_url'],
      $data['name'] . now()->timestamp
    );

    return $this->costumesRepository
      ->setCostume($costume)
      ->updateCostume($data);
  }

  public function destroyCostume(Costume $costume): bool
  {
    return $this->costumesRepository
      ->setCostume($costume)
      ->destroy();
  }

  public function filterCostumes(array $filters)
  {
    return $this->costumesRepository->filters($filters);
  }

  /**
   * @param string $value
   * @param array $columns
   * @return Collection
   */
  public function searchCostumes(string $value, array $columns): Collection
  {
    return $this->costumesRepository
      ->query()
      ->whereAny($columns, 'like', "%{$value}%")
      ->get();
  }

  public function getAvailableCostumes(): Collection
  {
    return $this->costumesRepository
      ->doesntHave(['currentCostumeHistory', 'activeRepairHistories'])
      ->query()
      ->orderByDesc('created_at')
      ->get();
  }

  /**
   * Need to format filters, because recieve entire object from Vue.js
   *
   * @param array $filters
   * @return array
   */
  protected function formattedFilters(array $filters): array
  {
    $array = [];

    foreach ($filters as $key => $values) {
      if ($key !== 'state' && $key !== 'genders') {
        foreach ($values as $value) {
          $array[$key][] = $value['id'];
        }
      } else {
        $array[$key] = $values;
      }
    }

    return $array;
  }
}
