<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'Luan',
            'filiere' => 'ISC',
            'year' => 3,
            'profile_picture_type' => 1,
        ]);

        User::factory()->create([
            'username' => 'Tom',
            'filiere' => 'ISC',
            'year' => 3,
            'profile_picture_type' => 1,
        ]);

        User::factory()->create([
            'username' => 'Sebastien',
            'filiere' => 'ISC',
            'year' => 2,
            'profile_picture_type' => 5,
        ]);
        User::factory()->create([
            'username' => 'Bob',
            'filiere' => 'IGI',
            'year' => 2,
            'profile_picture_type' => 5,
        ]);
        User::factory()->create([
            'username' => 'Alice',
            'filiere' => 'MIC',
            'year' => 1,
            'profile_picture_type' => 5,
        ]);
        User::factory()->create([
            'username' => 'Zoé',
            'filiere' => 'IDE',
            'year' => 1,
            'profile_picture_type' => 1,
        ]);
        User::factory()->create([
            'username' => 'Charlie',
            'filiere' => 'IGI',
            'year' => 3,
            'profile_picture_type' => 1,
        ]);
    }
}
