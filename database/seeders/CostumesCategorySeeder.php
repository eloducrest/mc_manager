<?php

namespace Database\Seeders;

use App\Models\CostumesCategory;
use Illuminate\Database\Seeder;

class CostumesCategorySeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    CostumesCategory::factory()->count(4)->create(); // 4 === robe, pantalon, veste, armure...
    // TODO : lister ttes les cat
  }
}
