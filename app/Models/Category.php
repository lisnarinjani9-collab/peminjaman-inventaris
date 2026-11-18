<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nama',
    ];

    // INDUK: satu kategori memiliki banyak aset
    public function assets()
    {
        return $this->hasMany(Asset::class, 'kategori_id');
    }
}
