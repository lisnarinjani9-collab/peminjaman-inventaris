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
        Schema::create('return_logs', function (Blueprint $table) {
            $table->id();
            // unique = satu pengajuan hanya punya satu catatan pengembalian (relasi 1 ke 1)
            $table->foreignId('peminjaman_id')->unique()->constrained('borrowings')->cascadeOnDelete();
            $table->foreignId('diverifikasi_oleh')->constrained('users')->cascadeOnDelete();
            $table->enum('kondisi_kembali', ['baik', 'rusak_ringan', 'rusak_berat']);
            // catatan kerusakan atau keterlambatan
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_logs');
    }
};
