<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $modules = [
            [
            'filiere_name' => 'ISC',
            'name' => 'Web application',
            'num_ue' => '2222.2',
            ],
            [
            'filiere_name' => 'ISC',
            'name' => 'Cryptographie',
            'num_ue' => '1111.1',
            ]
        ];

        DB::table('modules')->insert($modules);

        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
