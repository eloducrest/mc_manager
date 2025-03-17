<?php

namespace App\Http\Controllers;

use App\Http\Requests\Actors\ActorCreateRequest;
use App\Http\Requests\Actors\ActorUpdateRequest;
use App\Models\Actor;
use App\Services\ActorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActorController extends Controller
{
  private ActorService $actorService;

  public function __construct(ActorService $actorService)
  {
    $this->actorService = $actorService;
  }

  public function index(): Response
  {
    return Inertia::render('Actors/ActorsIndex', [
      'actors' => $this->actorService->getActorsWithCurrentCostumesAndHistory(),
    ]);
  }

  public function view(Actor $actor): Response
  {
    return Inertia::render('Actors/ActorView', [
      'actor' => $this->actorService->getActorForView($actor),
    ]);
  }

  public function store(ActorCreateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->actorService
      ->storeActor($data);

    return to_route('actors.index');
  }

  public function update(ActorUpdateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->actorService
      ->updateActor($data);

    return $request->redirect === 'actors.index' ? to_route('actors.index') : to_route('actors.view', $data['id']);
  }

  public function search(Request $request): JsonResponse
  {
    $value = $request->query('value');

    $actors = $this->actorService
      ->searchActors($value, ['lastname', 'firstname', 'email', 'tel']);

    return response()->json($actors);
  }

  public function delete(Request $request): RedirectResponse
  {
    $this->actorService
      ->deleteActor($request->id);

    return to_route('actors.index');
  }
}
