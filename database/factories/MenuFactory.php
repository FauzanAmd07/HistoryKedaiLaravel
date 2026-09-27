<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_kategori' => Kategori::factory(),
            'nama_menu'   => $this->faker->words(2, true),
            'harga'       => $this->faker->numberBetween(10000, 50000),
            'gambar'      => null,
            'deskripsi'   => $this->faker->sentence(),
            'status_menu' => 'Tersedia',
        ];
    }
}
