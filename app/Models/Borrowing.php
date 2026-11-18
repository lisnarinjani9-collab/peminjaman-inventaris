<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'karyawan_id',
        'status',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];

    // ANAK: setiap pengajuan diajukan oleh satu karyawan (tabel users)
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }

    // INDUK: satu pengajuan berisi banyak baris detail
    public function details()
    {
        return $this->hasMany(BorrowingDetail::class, 'peminjaman_id');
    }

    // BANYAK KE BANYAK: satu pengajuan berisi banyak aset (lewat borrowing_details)
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'borrowing_details', 'peminjaman_id', 'aset_id')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    // INDUK 1 ke 1: satu pengajuan punya satu catatan pengembalian
    public function returnLog()
    {
        return $this->hasOne(ReturnLog::class, 'peminjaman_id');
    }
}
