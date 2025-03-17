<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostumeHistory\AssociateCostumesToActorRequest;
use App\Http\Requests\CostumeHistory\DissociateCostumeToActorRequest;
use App\Services\CostumeHistoryService;
use Illuminate\Http\RedirectResponse;

class CostumeHistoryController extends Controller
{
  private CostumeHistoryService $costumeHistoryService;

  public function __construct(CostumeHistoryService $costumeHistoryService)
  {
    $this->costumeHistoryService = $costumeHistoryService;
  }

  public function associateCostumesToActor(AssociateCostumesToActorRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->costumeHistoryService
      ->associateCostumesToActor($data['actor_id'], $data['costumes']);

    return to_route($request->input('redirect.route_name'), $request->input('redirect.id'));
  }

  public function dissociateCostumeToActor(DissociateCostumeToActorRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->costumeHistoryService->dissociateCostumeToActor($data);

    return to_route($request->input('redirect.route_name'), $request->input('redirect.id'));
  }
}
