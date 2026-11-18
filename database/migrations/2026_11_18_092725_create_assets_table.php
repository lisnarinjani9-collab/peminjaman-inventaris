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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('categories')->restrictOnDelete();
            $table->string('nama', 150);
            $table->unsignedInteger('stok_awal');
            $table->unsignedInteger('stok_tersedia');
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            // TAMBAHAN: penanda aset bernilai tinggi (butuh persetujuan akhir Admin GA)
            $table->boolean('bernilai_tinggi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
