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
                'email' => 'administrator@ivfi.or.id',
                'password' => Hash::make('Adminivfi246'),
                'role' => 'admin',
            ],
            // [
            //     'fullname' => 'SMK ISFI BANJARMASIN',
            //     'email' => 'smkisfi@smkisfi.com',
            //     'password' => Hash::make('password'),
            //     'role' => 'user',
            // ],
        ]);
    }
}
