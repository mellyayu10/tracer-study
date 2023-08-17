<?php

namespace Database\Seeders;

use App\Models\KategoriKuisioner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriKuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Data Pribadi",
            "slug" => "data-pribadi",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Data Akademik",
            "slug" => "data-akademik",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Data Pekerjaan",
            "slug" => "data-pekerjaan",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Data Bagi Alumni Yang Melanjutkan Studi Lanjut",
            "slug" => "data-bagi-alumni-yang-melanjutkan-studi-lanjut",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Data Alumni Yang Berwirausaha",
            "slug" => "data-alumni-yang-berwirausaha",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "Kesan dan Saran",
            "slug" => "kesan-dan-saran",
            "tipe_kuisioner" => 1
        ]);

        KategoriKuisioner::create([
            "nama_kategori_kuisioner" => "IDENTITAS LEMBAGA ATAU PERUSAHAAN",
            "slug" => "identitas-lembaga-atau-perusahaan",
            "tipe_kuisioner" => 2
        ]);
    }
}
