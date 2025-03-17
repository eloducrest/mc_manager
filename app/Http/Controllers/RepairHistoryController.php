<?php

namespace App\Http\Controllers;

use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use App\Events\SetIsRepairedCostumeEvent;
use App\Http\Requests\Repairs\ToBeRepairedRequest;
use App\Models\Costume;
use App\Models\CostumesCategory;
use App\Models\Period;
use App\Models\RepairHistory;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RepairHistoryController extends Controller
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

  public function index()
  {
    return Inertia::render('Repairs/RepairsIndex', [
      'repairs' => Costume::where('is_to_be_repaired', true)
        ->with([
          'activeRepairHistories',
          'size',
          'category',
          'period',
          'actors',
          'currentCostumeHistory',
          'historyActors'
        ])
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

  public function toBeRepaired(ToBeRepairedRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $repair_history = RepairHistory::create([
      'costume_id' => $data['costume_id'],
      'repair_comment' => $data['repair_comment'],
      'condition_before_repair' => $data['condition_before_repair'],
    ]);

    $repair_history->costume->update([
      'is_to_be_repaired' => true
    ]);

    return to_route($request->input('redirect.route_name'), $request->input('redirect.id'));
  }

  public function repaired(Request $request): RedirectResponse
  {
    $repair_history = RepairHistory::where('costume_id', $request->costume_id)->first();

    $repair_history->update([
      'resolved_comment' => $request->resolved_comment,
      'condition_after_repair' => $request->condition_after_repair
    ]);

    SetIsRepairedCostumeEvent::dispatch($repair_history);

    $repair_history->delete();

    return to_route('repairs.index');
  }
}
