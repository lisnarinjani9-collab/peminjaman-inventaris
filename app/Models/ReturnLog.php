<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnLog extends Model
{
    use HasFactory;

    protected $table = 'return_logs';

    protected $fillable = [
        'peminjaman_id',
        'diverifikasi_oleh',
        'kondisi_kembali',
        'catatan',
    ];

    // ANAK: catatan pengembalian ini milik satu pengajuan
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'peminjaman_id');
    }

    // ANAK: petugas gudang yang memverifikasi (tabel users)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
