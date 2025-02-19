<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('certifications')->insert([
            'title' => 'Sertifikasi Pengembangan Perangkat Lunak',
            'description' => 'Sertifikasi ini untuk pengembang perangkat lunak',
            'price' => 300,
            'valid_period' => 12,
        ]);

        DB::table('certifications')->insert([
            'title' => 'Sertifikasi Jaringan Komputer',
            'description' => 'Sertifikasi ini untuk ahli jaringan komputer',
            'price' => 250,
            'valid_period' => 12,
        ]);
    }
}
