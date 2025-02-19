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
        DB::table('registrations')->insert([
            'member_id' => 1,
            'certification_id' => 1,
            'registration_date' => now(),
            'status' => 'registered',
        ]);

        DB::table('registrations')->insert([
            'member_id' => 1,
            'certification_id' => 2,
            'registration_date' => now(),
            'status' => 'registered',
        ]);
    }
}
