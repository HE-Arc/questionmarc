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
    public function run(): void #TODO alter table to increase character limit for name
    {
        $modules = [];

        $file = './modules_v006.csv'; #TODO change the path to the file

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle);

            $modules = [];

            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                if (count($data) >= 9) {
                    $data = array_map(fn($field) => mb_convert_encoding($field, 'UTF-8', 'auto'), $data); #TODO remove after alter table encoding of modules

                    $module = [
                        'filiere_name' => substr($data[0], 0, -1),
                        'name' => $data[8],
                        'num_ue' => $data[7],
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
