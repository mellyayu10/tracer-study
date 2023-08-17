<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumni::create([
            "user_id" => 2,
            "nim" => "2003077",
            "prodi_id" => 1,
            "jenis_kelamin" => "L",
            "bulan_masuk" => "Desember",
            "tahun_masuk" => "2020",
            "bulan_lulus" => "Januari",
            "tahun_lulus" => "2022"
        ]);
    }
}
