<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    Size::factory()->count(4)->create(); // 4 === S, M, L, XL
  }
}
