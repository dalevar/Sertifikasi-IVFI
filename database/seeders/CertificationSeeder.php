<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 2; $i++) {
            DB::table('certifications')->insert([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'price' => $faker->numberBetween(100, 500),
                'valid_period' => $faker->numberBetween(2, 3),
            ]);
        }
    }
}
