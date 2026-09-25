<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default sesuai README blueprint
        User::create([
            'nama'            => 'Pemilik Kedai',
            'username'        => 'pemilik',
            'password'        => Hash::make('admin123'),
            'jabatan'         => 'Pemilik',
            'status_karyawan' => 'Aktif',
        ]);

        User::create([
            'nama'            => 'Admin Kedai',
            'username'        => 'admin',
            'password'        => Hash::make('admin123'),
            'jabatan'         => 'Admin',
            'status_karyawan' => 'Aktif',
        ]);

        User::create([
            'nama'            => 'Kasir Kedai',
            'username'        => 'kasir',
            'password'        => Hash::make('kasir123'),
            'jabatan'         => 'Kasir',
            'status_karyawan' => 'Aktif',
        ]);
    }
}
