<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pelanggan' => Pelanggan::factory(),
            'id_karyawan'  => User::factory(),
            'tanggal'      => now(),
            'total_harga'  => $this->faker->numberBetween(20000, 150000),
            'status'       => 'Selesai',
            'metode_bayar' => $this->faker->randomElement(['Tunai', 'QRIS', 'Transfer']),
        ];
    }
}
