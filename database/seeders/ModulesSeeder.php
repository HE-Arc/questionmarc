<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [];

        $file = '../modules_v006.csv';

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle);

            $modules = [];

            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                if (count($data) >= 9) {

                    $module = [
                        'filiere_name' => substr($data[0], 0, -1),
                        'name' => $data[8],
                        'num_ue' => $data[7],
                        'year' => substr($data[0], 3, 1),
                    ];

                    $modules[] = $module;
                } else {
                    echo "Skipping row due to insufficient columns: ";
                }
            }

            fclose($handle);

        } else {
            echo "Could not open the file.";
        }

        DB::table('modules')->insert($modules);
    }
}
