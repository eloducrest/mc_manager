<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    Actor::factory()->count(150)->create();
  }
}
