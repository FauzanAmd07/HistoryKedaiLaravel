<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function createMenu(int $idKategori, string $namaMenu, float $harga, ?string $deskripsi = null): Menu
    {
        return Menu::create([
            'id_kategori' => $idKategori,
            'nama_menu'   => $namaMenu,
            'harga'       => $harga,
            'deskripsi'   => $deskripsi,
            'status_menu' => 'Tersedia',
        ]);
    }
}
