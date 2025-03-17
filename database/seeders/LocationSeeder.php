<?php

namespace Database\Seeders;

use App\Models\Costume;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    Location::factory()->count(20)->create();
  }
}
