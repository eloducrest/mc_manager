<?php

namespace App\Services;

use App\Models\Actor;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
  private UsersRepository $repository;

  public function __construct(UsersRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * @return Collection
   */
  public function getUsers(): Collection
  {
    return $this->repository
      ->query()
      ->orderByDesc('created_at')
      ->get();
  }

  /**
   * @param array $data
   * @return User
   */
  public function storeUser(array $data): User
  {
    return $this->repository->storeUser($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateUser(array $data): bool
  {
    $this->repository->findById($data['id']);

    return $this->repository->updateUser($data);
  }

  /**
   * @param User $user
   * @return bool
   */
  public function destroyUser(User $user): bool
  {
    return $this->repository
      ->setUser($user)
      ->deleteUser();
  }
}
