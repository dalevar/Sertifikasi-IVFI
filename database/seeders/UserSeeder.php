<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'fullname' => 'Admininstrator',
                'email' => 'admin@ivfi.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'fullname' => 'Ikatan Vokasi Farmasi Indonesia',
                'email' => 'ivfi@ivfi.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Gore Dale',
                'email' => 'dale@ivfi.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Joko',
                'email' => 'joko@ivfi.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        ]);
    }
}
