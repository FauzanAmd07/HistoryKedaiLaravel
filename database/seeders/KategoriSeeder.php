<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Kopi', 'Non-Kopi', 'Makanan', 'Camilan'];
        foreach ($kategoris as $nama) {
            Kategori::create(['nama_kategori' => $nama, 'status_kategori' => 'Tersedia']);
        }
    }
}
