<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersRepository
{
  private User $user;

  private ?Builder $query = null;

  private array $relations = [];

  public bool $withTrashed = false;

  /**
   * @return $this
   */
  public function withTrashed(): self
  {
    $this->withTrashed = true;

    return $this;
  }

  /**
   * @param array $relations
   * @return $this
   */
  public function relations(array $relations): self
  {
    $this->relations = $relations;

    return $this;
  }

  /**
   * @param string $relation
   * @return $this
   */
  public function addRelation(string $relation): self
  {
    $this->relations[] = $relation;

    return $this;
  }

  /**
   * @param int $id
   * @return User|null
   */
  public function findById(int $id): ?User
  {
    $this->user = $this->query()
      ->findOrFail($id);

    return $this->user;
  }

  /**
   * @param User $user
   * @return $this
   */
  public function setUser(User $user): self
  {
    $this->user = $user;

    return $this;
  }

  /**
   * @param array|null $relations
   * @return User
   */
  public function getUser(?array $relations = null): User
  {
    if ($relations) {
      return $this->user
        ->load($relations);
    }

    return $this->user;
  }

  /**
   * @param array $data
   * @return User
   */
  public function storeUser(array $data): User
  {
    return User::create($data);
  }

  /**
   * @param array $data
   * @return bool
   */
  public function updateUser(array $data): bool
  {
    return $this->user->update($data);
  }

  /**
   * @return bool
   */
  public function deleteUser(): bool
  {
    return $this->user->delete();
  }

  /**
   * @return Builder
   */
  public function query(): Builder
  {
    if (! $this->query) {
      $this->query = User::withTrashed($this->withTrashed)
        ->with($this->relations);
    }

    return $this->query;
  }
}
