<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('registrations')->insert([
                'member_id' => $faker->numberBetween(1, 10),
                'certification_id' => $faker->numberBetween(1, 2),
                'registration_date' => $faker->dateTimeThisYear(),
                'status' => $i < 5 ? 'approved' : 'pending',
            ]);
        }
    }
}
