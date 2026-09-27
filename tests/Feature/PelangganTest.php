<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelangganTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create([
            'nama_pelanggan' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $this->assertDatabaseHas('pelanggan', [
            'nama_pelanggan' => 'Budi Santoso',
        ]);
    }
}
