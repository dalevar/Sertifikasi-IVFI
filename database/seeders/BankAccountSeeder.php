<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_accounts')->insert([
            [
                'account_number' => '1234567890',
                'bank_name' => 'Bank Central Asia',
                'account_holder' => 'John Doe',
            ],
            [
                'account_number' => '0987654321',
                'bank_name' => 'Bank Mandiri',
                'account_holder' => 'Jane Smith',
            ],
            [
                'account_number' => '1122334455',
                'bank_name' => 'Bank Negara Indonesia',
                'account_holder' => 'Alice Johnson',
            ],
            [
                'account_number' => '5566778899',
                'bank_name' => 'Bank Rakyat Indonesia',
                'account_holder' => 'Bob Brown',
            ],
            [
                'account_number' => '6677889900',
                'bank_name' => 'Bank Tabungan Negara',
                'account_holder' => 'Charlie Davis',
            ],
        ]);
    }
}
