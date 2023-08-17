<?php

namespace Database\Seeders;

use App\Models\SettingKategoriKuisioner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingKategoriKuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingKategoriKuisioner::create([
            "kategori_kuisioner_id" => 1,
            "setting" => 3
        ]);

        SettingKategoriKuisioner::create([
            "kategori_kuisioner_id" => 2,
            "setting" => 1
        ]);

        SettingKategoriKuisioner::crete([
            "kategori_kuisioner_id" => 2,
            "setting" => 3
        ]);

        SettingKategoriKuisioner::create([
            "kategori_kuisioner_id" => 3,
            "setting" => 3
        ]);

        SettingKategoriKuisioner::create([
            "kategori_kuisioner_id" => 3,
            "setting" => 2
        ]);
    }
}
