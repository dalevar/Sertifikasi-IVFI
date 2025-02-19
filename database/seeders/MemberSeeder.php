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
        DB::table('members')->insert(
            [
                [
                    'user_id' => 2,
                    'fullname' => 'John Doe',
                    'number_identity' => '123456789',
                    'birthplace' => 'Jakarta',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 2,
                    'fullname' => 'Jane Smith',
                    'number_identity' => '987654321',
                    'birthplace' => 'Bandung',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 2,
                    'fullname' => 'Michael Johnson',
                    'number_identity' => '123123123',
                    'birthplace' => 'Surabaya',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 2,
                    'fullname' => 'Jessica Brown',
                    'number_identity' => '456456456',
                    'birthplace' => 'Medan',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 2,
                    'fullname' => 'William Davis',
                    'number_identity' => '789789789',
                    'birthplace' => 'Bali',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'fullname' => 'Amanda Wilson',
                    'number_identity' => '321321321',
                    'birthplace' => 'Yogyakarta',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'fullname' => 'Daniel Lee',
                    'number_identity' => '654654654',
                    'birthplace' => 'Semarang',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'fullname' => 'Olivia Martinez',
                    'number_identity' => '987987987',
                    'birthplace' => 'Makassar',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'fullname' => 'Ethan Clark',
                    'number_identity' => '147147147',
                    'birthplace' => 'Palembang',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'fullname' => 'Sophia Rodriguez',
                    'number_identity' => '258258258',
                    'birthplace' => 'Balikpapan',
                    'birthday' => '12-12-2002',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
