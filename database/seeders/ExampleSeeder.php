<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating 10 questions
        $questions = [];
        for ($i = 0; $i < 10; $i++) {
            $questions[] = [
                'title' => 'Question ' . $i,
                'content' => 'Content of question ' . $i,
                'user_id' => 1,
                'module_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('questions')->insert($questions);

    }
}
