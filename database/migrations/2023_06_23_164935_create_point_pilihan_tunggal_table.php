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
        Schema::create('point_pilihan_tunggal', function (Blueprint $table) {
            $table->id();
            $table->integer("detail_kategori_kuisioner_id");
            $table->string("nama_point");
            $table->enum("is_child", [1, 0])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_pilihan_tunggal');
    }
};
