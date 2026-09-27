<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KedaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Default Admin & Cashier Users
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Administrator Kedai',
                'password' => Hash::make('password123'),
                'jabatan' => 'Admin',
                'status_karyawan' => 'Aktif',
            ]
        );

        $kasir = User::firstOrCreate(
            ['username' => 'kasir1'],
            [
                'nama' => 'Kasir Utama',
                'password' => Hash::make('password123'),
                'jabatan' => 'Kasir',
                'status_karyawan' => 'Aktif',
            ]
        );

        // 2. Seed Initial Categories
        $kopi = Kategori::create(['nama_kategori' => 'Kopi', 'status_kategori' => 'Aktif']);
        $nonKopi = Kategori::create(['nama_kategori' => 'Non-Kopi', 'status_kategori' => 'Aktif']);
        $makanan = Kategori::create(['nama_kategori' => 'Makanan Ringan', 'status_kategori' => 'Aktif']);

        // 3. Seed Initial Menus
        Menu::create([
            'id_kategori' => $kopi->id_kategori,
            'nama_menu' => 'Es Kopi Susu History',
            'harga' => 18000,
            'deskripsi' => 'Kopi espresso dengan susu segar dan gula aren asli',
            'status_menu' => 'Tersedia',
        ]);

        Menu::create([
            'id_kategori' => $nonKopi->id_kategori,
            'nama_menu' => 'Matcha Latte',
            'harga' => 22000,
            'deskripsi' => 'Matcha jepang pilihan dipadu susu creamy',
            'status_menu' => 'Tersedia',
        ]);

        Menu::create([
            'id_kategori' => $makanan->id_kategori,
            'nama_menu' => 'French Fries Crisp',
            'harga' => 15000,
            'deskripsi' => 'Kentang goreng renyah dengan bumbu spesial',
            'status_menu' => 'Tersedia',
        ]);
    }
}
