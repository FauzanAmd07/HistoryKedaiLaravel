<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriKopi = Kategori::where('nama_kategori', 'Kopi')->first() ?? Kategori::create(['nama_kategori' => 'Kopi', 'status_kategori' => 'Aktif']);

        $menus = [
            ['nama_menu' => 'Americano Hot', 'harga' => 15000, 'deskripsi' => 'Espresso dengan air panas'],
            ['nama_menu' => 'Cappuccino Ice', 'harga' => 20000, 'deskripsi' => 'Espresso dengan susu dan foam lembut'],
            ['nama_menu' => 'Caramel Macchiato', 'harga' => 25000, 'deskripsi' => 'Espresso, susu, dan sirup karamel manis'],
        ];

        foreach ($menus as $menu) {
            Menu::create(array_merge($menu, [
                'id_kategori' => $kategoriKopi->id_kategori,
                'status_menu' => 'Tersedia',
            ]));
        }
    }
}