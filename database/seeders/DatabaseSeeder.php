<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)
             ->hasPosts(rand(1, 5))
             ->create();

         User::factory()->create([
             'name' => 'Test User',
             'email' => 'admin@test.cz',
         ]);
    }
}
