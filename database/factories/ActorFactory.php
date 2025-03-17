<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ActorFactory extends Factory
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
        return [
            'lastname' => fake()->lastName,
            'firstname' => fake()->firstName,
            'email' => fake()->unique()->email,
            'tel' => fake()->phoneNumber,
            'address' => fake()->address,
            'zip_code' => fake()->postcode,
            'city' => fake()->city,
            'is_volunteer' => fake()->boolean(),
            'size' => fake()->numberBetween(30, 50),
            'shoe_size' => fake()->numberBetween(25, 48),
        ];
    }
}
