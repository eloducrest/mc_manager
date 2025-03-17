<?php

namespace App\Http\Controllers;

use App\Http\Requests\Costumes\CostumeCreateRequest;
use App\Http\Requests\Costumes\CostumeToActorRequest;
use App\Http\Requests\Costumes\CostumeUpdateRequest;
use App\Models\Costume;
use App\Models\CostumeHistory;
use App\Repositories\CostumesRepository;
use App\Services\CostumeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class CostumeController extends Controller
{
  protected array $costume_relations;

  private CostumeService $costumeService;

  public function __construct(CostumeService $costumeService)
  {
    $this->costumeService = $costumeService;

    $this->costume_relations = [
      'size',
      'location',
      'category',
      'period',
      'actors',
      'currentCostumeHistory',
      'historyActors'
    ];
  }

  public function index(): Response
  {
    return Inertia::render('Costumes/CostumeIndex', [
      'costumes' => $this->costumeService->getCostumesForIndex(),
    ]);
  }

  public function view(Costume $costume): Response
  {
    return Inertia::render('Costumes/CostumeView', [
      'costume' => $this->costumeService->getCostumeForView($costume),
    ]);
  }

  public function store(CostumeCreateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->costumeService
      ->storeCostume($data);

    return to_route('costumes.index');
  }

  public function update(CostumeUpdateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->costumeService
      ->updateCostume($data);

    return to_route($request->input('redirect.route_name'), $request->input('redirect.id'));
  }

  public function search(): JsonResponse
  {
    $filters = request()->input('filters', []);

    $costumes = $this->costumeService
      ->getFilteredCostumes($filters);

    return response()->json($costumes);
  }

  public function destroy(Costume $costume): RedirectResponse
  {
    $this->costumeService->destroyCostume($costume);

    return to_route('costumes.index');
  }

  public function getAvailableCostumes()
  {
    $costume = $this->costumeService->getAvailableCostumes();

    return response()->json($costume);
  }
}
