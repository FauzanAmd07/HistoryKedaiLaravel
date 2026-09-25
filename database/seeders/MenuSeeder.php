<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['id_kategori' => 1, 'nama_menu' => 'Kopi Susu History', 'harga' => 18000, 'deskripsi' => 'Kopi susu khas History Kedai yang lezat', 'gambar' => 'gambar/1764293036_Coffe - Signature Coffe Gula Aren.png'],
            ['id_kategori' => 1, 'nama_menu' => 'Americano Hot/Ice', 'harga' => 15000, 'deskripsi' => 'Americano segar pilihan dengan biji kopi terbaik', 'gambar' => 'gambar/1764293008_Coffe - Signature Nescafe Mocha.png'],
            ['id_kategori' => 2, 'nama_menu' => 'Matcha Latte', 'harga' => 22000, 'deskripsi' => 'Matcha latte autentik yang creamy dan menyegarkan', 'gambar' => 'gambar/1764292973_Tea - Green Tea.png'],
            ['id_kategori' => 2, 'nama_menu' => 'Chocolate Classic', 'harga' => 20000, 'deskripsi' => 'Cokelat klasik premium yang kaya rasa', 'gambar' => 'gambar/1764292787_Float - Mocha Float.png'],
            ['id_kategori' => 3, 'nama_menu' => 'Nasi Goreng Special', 'harga' => 25000, 'deskripsi' => 'Nasi goreng spesial History Kedai dengan bumbu rahasia', 'gambar' => ''],
            ['id_kategori' => 4, 'nama_menu' => 'Roti Bakar Cokelat', 'harga' => 15000, 'deskripsi' => 'Roti bakar renyah dengan taburan cokelat melimpah', 'gambar' => ''],
        ];

        foreach ($menus as $menu) {
            Menu::create(array_merge($menu, ['status_menu' => 'Tersedia']));
        }
    }
}