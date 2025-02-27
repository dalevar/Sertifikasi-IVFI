<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $members = [];
        for ($i = 0; $i < 10; $i++) {
            $members[] = [
                'user_id' => 2,
                'fullname' => $faker->name,
                'number_identity' => $faker->numerify('#########'),
                'birthplace' => $faker->city,
                'birthday' => $faker->date('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('members')->insert($members);
    }
}
