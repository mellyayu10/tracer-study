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
        Schema::create('rekomendasi_alumni', function (Blueprint $table) {
            $table->id();
            $table->integer("alumni_id");
            $table->string("nama", 100);
            $table->string("nomer_hp", 30);
            $table->enum("status", [1, 0, 2])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_alumni');
    }
};
