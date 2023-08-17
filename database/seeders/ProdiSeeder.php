<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            "nama_prodi" => "D4 Perancangan Manufaktur"
        ]);

        Prodi::create([
            "nama_prodi" => "D3 Teknik Mesin"
        ]);

        Prodi::create([
            "nama_prodi" => "D3 Teknik Informatika"
        ]);
    }
}
