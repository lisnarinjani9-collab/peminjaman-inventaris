<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin GA
        User::Create([
            'email' => 'rinjaniimut@gmail.com',
            'nama' => 'Rinjani',
            'password' => Hash::make('password'),
            'role' => 'admin_ga',
            'divisi' => 'General Affairs',
        ]);

        // Petugas Gudang
        User::Create([
            'email' => 'jian@gmail.com',
            'nama' => 'Jian',
            'password' => Hash::make('password'),
            'role' => 'petugas_gudang',
            'divisi' => 'Gudang',
            ]);

        // Karyawan
        User::Create([
            'email' => 'arya@gmail.com',
            'nama' => 'Arya',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'divisi' => 'Marketing',
            ]);
    }
}
