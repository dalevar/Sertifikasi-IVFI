<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_details')->insert([
            ['users_id' => 1, 'photo' => 'admin.jpg', 'address' => 'Jl. Merdeka', 'phone' => '081234567890'],
            ['users_id' => 2, 'photo' => 'dale.jpg', 'address' => 'Jl. Sudirman', 'phone' => '081234567891'],
        ]);
    }
}
