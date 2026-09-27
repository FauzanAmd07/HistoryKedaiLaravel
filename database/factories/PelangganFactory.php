<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pelanggan' => $this->faker->name(),
            'no_hp'          => $this->faker->phoneNumber(),
            'email'          => $this->faker->safeEmail(),
        ];
    }
}
