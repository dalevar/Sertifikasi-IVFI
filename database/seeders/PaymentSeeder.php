<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert(
            [
                [
                    'user_id' => 2,
                    'total_members' => 5,
                    'total_amount' => 1500,
                    'status' => 'paid',
                    'date' => now(),
                    'validation' => 'validated',
                ],
                [
                    'user_id' => 2,
                    'total_members' => 3,
                    'total_amount' => 900,
                    'status' => 'pending',
                    'date' => now(),
                    'validation' => 'pending',
                ],
                [
                    'user_id' => 2,
                    'total_members' => 2,
                    'total_amount' => 600,
                    'status' => 'failed',
                    'date' => now(),
                    'validation' => 'rejected',
                ]
            ]
        );
    }
}
