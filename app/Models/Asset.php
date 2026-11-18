<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'kategori_id',
        'nama',
        'stok_awal',
        'stok_tersedia',
        'kondisi',
        'bernilai_tinggi',
    ];

    protected $casts = [
        'bernilai_tinggi' => 'boolean',
    ];

    // ANAK: setiap aset milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    // INDUK: satu aset muncul di banyak baris borrowing_details
    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class, 'aset_id');
    }

    // BANYAK KE BANYAK: satu aset bisa ada di banyak pengajuan (lewat borrowing_details)
    public function borrowings()
    {
        return $this->belongsToMany(Borrowing::class, 'borrowing_details', 'aset_id', 'peminjaman_id')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
