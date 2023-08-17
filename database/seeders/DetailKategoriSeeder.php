<?php

namespace Database\Seeders;

use App\Models\DetailKategoriKuisioner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 1,
            "nama_soal" => "SARANA TERMUDAH UNTUK MENGHUBUNGI ANDA",
            "slug" => "sarana-termudah-untuk-menghubungi-anda",
            "tipe_soal" => 3
        ]);

        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 1,
            "nama_soal" => "SETELAH LULUS APA KEGIATAN ANDA",
            "slug" => "setelah-lulus-apa-kegiatan-anda",
            "tipe_soal" => 3
        ]);

        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 2,
            "nama_soal" => "TAHUN MASUK UNIVERSITAS PERADABAN (MENGGUNAKAN SELECT TIME)",
            "slug" => "tahun-masuk-universitas-peradaban",
            "tipe_soal" => 1
        ]);

        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 2,
            "nama_soal" => "TAHUN LULUS UNIVERSITAS PERADABAN (MENGGUNAKAN SELECT TIME)",
            "slug" => "tahun-lulus",
            "tipe_soal" => 1
        ]);

        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 3,
            "nama_soal" => "PERNAH MELAMAR PEKERJAAN ?",
            "slug" => "pernah-melamar-pekerjaan",
            "tipe_soal" => 2
        ]);

        DetailKategoriKuisioner::create([
            "kategori_kuisioner_id" => 3,
            "nama_soal" => "JENIS PEKERJAAN",
            "slug" => "jenis-pekerjaan",
            "tipe_soal" => 2
        ]);
    }
}
