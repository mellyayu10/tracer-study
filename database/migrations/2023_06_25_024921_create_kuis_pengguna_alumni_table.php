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
        Schema::create('kuis_pengguna_alumni', function (Blueprint $table) {
            $table->id();
            $table->string("riwayat_pekerjaan_id");
            $table->text("text");
            $table->date("tanggal_isi_kuis");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis_pengguna_alumni');
    }
};
