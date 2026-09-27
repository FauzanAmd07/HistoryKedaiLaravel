<?php

namespace Database\Factories;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksi>
 */
class DetailTransaksiFactory extends Factory
{
    protected $model = DetailTransaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jumlah = $this->faker->numberBetween(1, 4);
        $harga = $this->faker->numberBetween(15000, 45000);

        return [
            'id_transaksi' => Transaksi::factory(),
            'id_menu'      => Menu::factory(),
            'jumlah'       => $jumlah,
            'subtotal'     => $jumlah * $harga,
        ];
    }
}
