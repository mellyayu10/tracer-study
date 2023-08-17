<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_pekerjaan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->integer("alumni_id");
            $table->string("nama_instansi")->nullable();
            $table->text("alamat_instansi")->nullable();
            $table->enum("skala", ["Nasional", "Lokal", "Internasional"])->nullable();
            $table->string("profesi", 100)->nullable();
            $table->double("penghasilan_tiap_bulan")->nullable();
            $table->string("periode_bulan_mulai", 50)->nullable();
            $table->year("periode_kerja_mulai")->nullable();
            $table->string("periode_bulan_akhir", 50)->nullable();
            $table->year("periode_kerja_akhir")->nullable();
            $table->string("pengguna_alumni")->nullable();
            $table->string("divisi", 100)->nullable();
            $table->string("email")->unique()->nullable();
            $table->string("nomor_hp", 30)->nullable();
            $table->string("provinsi")->nullable();
            $table->string("kota_kab")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kelurahan")->nullable();
            $table->tinyInteger("is_kuisioner")->default(0);
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pekerjaan');
    }
};
