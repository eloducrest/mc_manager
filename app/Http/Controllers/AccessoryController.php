<?php

namespace App\Http\Controllers;

use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use App\Http\Requests\Costumes\CostumeCreateRequest;
use App\Http\Requests\Costumes\CostumeToActorRequest;
use App\Http\Requests\Costumes\CostumeUpdateRequest;
use App\Http\Requests\Costumes\DissociateCostumeToActorRequest;
use App\Models\CostumeHistory;
use App\Models\Costume;
use App\Models\CostumesCategory;
use App\Models\Period;
use App\Models\Size;
use App\Repositories\AccessoriesRepository;
use App\Repositories\CostumesRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AccessoryController extends Controller
{
  protected array $costume_relations;

  public function __construct()
  {
    $this->costume_relations = [
      'size',
      'category',
      'period',
      'actors',
      'currentCostumeHistory',
      'historyActors'
    ];
  }

  public function index(AccessoriesRepository $repository): Response
  {
    return Inertia::render('Accessories/AccessoriesIndex', [
      'costumes' => $repository->withRelationships($this->costume_relations)
        ->query()
        ->orderByDesc('created_at')
        ->get(),
      'costumes_settings' => [
        'periods' => Period::all(),
        'categories' => CostumesCategory::all(),
        'sizes' => Size::all(),
        'genders' => GenderEnum::toArray(),
        'conditions' => CostumeConditionEnum::cases()
      ],
    ]);
  }

  public function view(Costume $costume): Response
  {
    return Inertia::render('Costumes/CostumeView', [
      'costume' => $costume->load($this->costume_relations),
      'costumes_settings' => [
        'periods' => Period::all(),
        'categories' => CostumesCategory::all(),
        'sizes' => Size::all(),
        'genders' => GenderEnum::toArray(),
        'conditions' => CostumeConditionEnum::cases()
      ],
    ]);
  }

  public function store(CostumeCreateRequest $request): JsonResponse
  {
    $data = $request->validated();

    $data['img_url'] = $this->setImageUrl(
      $request->file('img_url'),
      $data['name']
    );

    $costume = Costume::create($data);

    return response()->json($costume);
  }

  public function update(CostumeUpdateRequest $request): JsonResponse
  {
    $data = $request->validated();

    $data['img_url'] = $this->setImageUrl(
      $request->file('img_url'),
      $data['name'] . now()
    );

    $costume = Costume::find($request->id);

    $costume->update($data);

    return response()->json($costume->load($this->costume_relations));
  }

  public function search(Request $request, AccessoriesRepository $repository)
  {
    $filters = $request->query('filters');

    if ($request->has('filters')
      || isset($filters['periods'])
      || isset($filters['sizes'])
      || isset($filters['categories'])
      || isset($filters['genders']))
    {
      $costumes = $repository
        ->withRelationships($this->costume_relations)
        ->filters($filters)
        ->get();
    } else {
      $costumes = $repository
        ->withRelationships($this->costume_relations)
        ->query()
        ->get();
    }

    return response()->json($costumes);
  }

  public function delete(Costume $costume): JsonResponse
  {
    CostumeHistory::where('costume_id', $costume->id)
      ->delete();

    $costume->delete();

    return response()->json();
  }

  public function associateToActor(CostumeToActorRequest $request): JsonResponse
  {
    $data = $request->validated();

    $costume = Costume::find($data['costume_id']);

    $costume->actors()->attach($data['actor_id'], [
      'amount_deposit' => $data['deposit']
    ]);

    return response()->json($costume->load($this->costume_relations));
  }

  public function dissociateToActor(DissociateCostumeToActorRequest $request): JsonResponse
  {
    $data = $request->validated();

    $costume = Costume::find($data['costume_id']);

    $costume->currentCostumeHistory->update([
      'amount_returned_deposit' => $data['amount_returned_deposit'],
      'return_condition' => $data['return_condition'],
      'returned_at' => now(),
      'is_to_be_repaired' => $data['is_to_be_repaired'],
      'comments' => $data['comments'] ?? null
    ]);

    //$costume->activeCostumeHistory->delete();

    return response()->json($costume->load($this->costume_relations));
  }

  public function getAvailableCostumes(CostumesRepository $repository): JsonResponse
  {
    return response()->json(
      $repository->query($this->costume_relations)
        ->whereDoesntHave('currentCostumeHistory')
        ->orderByDesc('created_at')
        ->get()
    );
  }

  protected function setImageUrl($file, string $name): string
  {
    $ext = $file->extension();
    $path = $file->storeAs('costumes', Str::slug($name) . '.' . $ext, 'public');

    return '/storage/' . $path;
  }

}
