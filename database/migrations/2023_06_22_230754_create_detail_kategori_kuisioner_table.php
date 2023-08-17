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
        Schema::create('detail_kategori_kuisioner', function (Blueprint $table) {
            $table->id();
            $table->integer("kategori_kuisioner_id");
            $table->string("nama_soal");
            $table->string("slug");
            $table->enum("tipe_soal", [1, 2, 3]);
            $table->enum("is_kuisioner", [1, 0]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kategori_kuisioner');
    }
};
