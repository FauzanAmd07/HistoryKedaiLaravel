<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiTest extends TestCase
{
    use RefreshDatabase;

    public function test_kasir_can_access_transaksi_page(): void
    {
        $user = User::factory()->create(['jabatan' => 'Kasir']);

        $response = $this->actingAs($user)->get(route('transaksi.index'));

        $response->assertStatus(200);
    }
}
