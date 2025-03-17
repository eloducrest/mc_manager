<?php

namespace Database\Seeders;

use App\Models\CostumeHistory;
use Illuminate\Database\Seeder;

class CostumeHistorySeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    CostumeHistory::factory()->count(10)->create();
  }
}
