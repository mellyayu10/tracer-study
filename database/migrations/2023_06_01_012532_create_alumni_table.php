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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("nim", 50);
            $table->integer("prodi_id");
            $table->enum("jenis_kelamin", ["L", "P"])->nullable();
            $table->string("bulan_masuk", 50);
            $table->year("tahun_masuk");
            $table->string("bulan_lulus", 50);
            $table->year("tahun_lulus");
            $table->string("foto")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->text("alamat");
            $table->string("provinsi")->nullable();
            $table->string("kota_kab")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kelurahan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
