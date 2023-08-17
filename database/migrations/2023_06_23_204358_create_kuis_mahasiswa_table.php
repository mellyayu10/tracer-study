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
        Schema::create('kuis_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->integer("alumni_id");
            $table->longText("text");
            $table->string("pekerjaan_id", 50)->nullable();
            $table->date("tanggal_isi_kuis");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis_mahasiswa');
    }
};
