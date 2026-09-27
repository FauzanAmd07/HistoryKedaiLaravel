<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = ['Espresso Base', 'Manual Brew', 'Tea & Mocktail', 'Dessert & Snacks'];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $nama],
                ['status_kategori' => 'Aktif']
            );
        }
    }
}
