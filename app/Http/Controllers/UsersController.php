<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CostumeCreateRequest;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
  protected UserService $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function index(): Response
  {
    return Inertia::render('Users/IndexUsers', [
      'users' => $this->userService->getUsers()->except(Auth::id())
    ]);
  }

  public function store(UserCreateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->userService
      ->storeUser($data);

    return to_route('users.index');
  }

  public function update(UserUpdateRequest $request): RedirectResponse
  {
    $data = $request->validated();

    $this->userService
      ->updateUser($data);

    return to_route('users.index');
  }

  public function destroy(User $user): RedirectResponse
  {
    $this->userService
      ->destroyUser($user);

    return to_route('users.index');
  }
}
