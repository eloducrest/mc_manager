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
class CostumeFactory extends Factory
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
            'period_id' => Period::all()->random()->id,
            'costumes_category_id' => CostumesCategory::all()->random()->id,
            'size_id' => Size::all()->random()->id,
            'location_id' => Location::all()->random()->id,
            'img_url' => '/image/empty.jpg',
            'number' => Str::random(5),
            'name' => fake()->name,
            'description' => fake()->text,
            'condition' => fake()->randomElement(CostumeConditionEnum::cases()),
            'gender' => fake()->randomElement(GenderEnum::cases()),
            'type' => fake()->randomElement(CostumeTypeEnum::cases()),
            'deposit' => fake()->randomNumber(),
            'price' => fake()->randomNumber(),
            'is_to_be_repaired' => false
        ];
    }
}
