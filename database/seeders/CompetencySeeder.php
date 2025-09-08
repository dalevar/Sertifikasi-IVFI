<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'unit_name' => $faker->sentence(3),
                'unit_code' => (string)$i,
                'certification_id' => $faker->numberBetween(1, 2),
            ];
        }

        DB::table('competency_units')->insert($data);
    }
}
