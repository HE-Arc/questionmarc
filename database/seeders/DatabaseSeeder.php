<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'Test User',
            'filiere' => 'ISC',
            'year' => 1,
            'profile_picture' => 'default.png',
        ]);

        $this->call([
            ExampleSeeder::class,
        ]);
    }
}
