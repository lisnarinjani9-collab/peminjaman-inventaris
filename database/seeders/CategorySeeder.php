<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Elektronik', 'Kendaraan', 'Ruangan', 'Perlengkapan Kantor'];

        foreach ($kategori as $nama) {
            Category::create(['nama' => $nama]);
        }
    }
}
