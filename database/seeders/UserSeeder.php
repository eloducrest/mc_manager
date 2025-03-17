<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $users = [
      [
        'lastname' => 'du Crest',
        'firstname' => 'Toutoune',
        'role' => 'admin',
        'function' => 'Présidente',
        'email' => 'montjoie.spectacle@gmail.com',
        'tel' => '0659712646',
        'password' => Hash::make('password'),
      ],
      [
        'lastname' => 'du Crest',
        'firstname' => 'Eloi',
        'role' => 'admin',
        'function' => 'dev',
        'tel' => '0642840558',
        'email' => 'eloi@letmotiv.io',
        'password' => Hash::make('password'),
      ]
    ];

    foreach ($users as $user) {
      User::factory()->create($user);
    }
  }
}
