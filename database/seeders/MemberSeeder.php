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
        DB::table('members')->insert([
            'user_id' => 1,
            'fullname' => 'John Doe',
            'number_identity' => '123456789',
            'birthplace' => 'Jakarta',
            'birthday' => '12-12-2002',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
