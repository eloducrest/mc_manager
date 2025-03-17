<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Costume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CostumeHistoryFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $costume = Costume::all()->random();

    return [
      'actor_id' => Actor::all()->random()->id,
      'costume_id' => $costume->id,
      'amount_deposit' => fake()->randomFloat(),
      'take_condition' => $costume->condition,
      'return_condition' => null,
      'returned_at' => null,
      'amount_returned_deposit' => null,
      'is_to_be_repaired' => false,
      'comments' => null,
    ];
  }
}
