<?php

namespace Database\Factories;

use App\Enum\CostumeConditionEnum;
use App\Enum\CostumeTypeEnum;
use App\Enum\GenderEnum;
use App\Models\CostumesCategory;
use App\Models\Location;
use App\Models\Period;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class LocationFactory extends Factory
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
            'name' => fake()->domainName,
            'label' => fake()->name,
            'description' => fake()->text,
            'code' => fake()->randomNumber(),
        ];
    }
}
