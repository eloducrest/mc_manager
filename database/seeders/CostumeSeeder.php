<?php

namespace Database\Seeders;

use App\Models\Costume;
use Illuminate\Database\Seeder;

class CostumeSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    Costume::factory()->count(100)->create();
  }
}
