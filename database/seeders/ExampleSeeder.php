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

        $module = [
            'filiere_name' => 'ISC',
            'name' => 'Web application',
            'num_ue' => '2222.2',
        ];

        DB::table('modules')->insert($module);

        // Creating 10 questions
        $questions = [];
        for ($i = 0; $i < 10; $i++) {
            $questions[] = [
                'title' => 'Question ' . $i,
                'content' => 'Content of question ' . $i,
                'author_id' => 1,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ];
        }

        DB::table('questions')->insert($questions);

    }
}
