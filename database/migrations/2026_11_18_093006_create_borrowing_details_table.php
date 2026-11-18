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
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('borrowings')->restrictOnDelete();
            $table->foreignId('aset_id')->constrained('assets')->restrictOnDelete();
            $table->unsignedInteger('jumlah');
            $table->timestamps();

            // satu aset hanya boleh muncul satu kali dalam satu pengajuan
            $table->unique(['peminjaman_id', 'aset_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
    }
};
