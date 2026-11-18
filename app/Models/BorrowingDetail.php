<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    use HasFactory;

    protected $table = 'borrowing_details';

    protected $fillable = [
        'peminjaman_id',
        'aset_id',
        'jumlah',
    ];

    // ANAK: baris detail ini milik satu pengajuan
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'peminjaman_id');
    }

    // ANAK: baris detail ini menunjuk ke satu aset
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'aset_id');
    }
}
