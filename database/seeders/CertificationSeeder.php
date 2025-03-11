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
            [
                'title' => 'Kompetensi Keahlian Farmasi Klinis dan Komunitas',
                'description' => 'Sertifikasi ini diperuntukkan bagi tenaga kesehatan yang bekerja di bidang farmasi klinis dan komunitas.',
                'price' => 500000,
                'valid_period' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kompetensi Keahlian Farmasi Industri',
                'description' => 'Sertifikasi ini diperuntukkan bagi tenaga kesehatan yang bekerja di bidang farmasi industri.',
                'price' => 600000,
                'valid_period' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
