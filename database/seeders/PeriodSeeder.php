<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $periods = [
      [
        'name' => 'Romaine',
        'label' => 'romaine'
      ],
      [
        'name' => 'Renaissance',
        'label' => 'renaissance'
      ],
      [
        'name' => 'XVIIè',
        'label' => 'XVII'
      ],
      [
        'name' => 'XIXè',
        'label' => 'XIX'
      ],
      [
        'name' => 'XXè',
        'label' => 'XX'
      ]
    ];
    foreach ($periods as $period) {
      Period::factory()->create($period);
    }
  }
}
