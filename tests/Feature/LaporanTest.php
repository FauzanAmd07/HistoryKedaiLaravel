<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    public function test_pemilik_can_access_laporan_page(): void
    {
        $pemilik = User::factory()->create(['jabatan' => 'Pemilik']);

        $response = $this->actingAs($pemilik)->get(route('laporan.index'));

        $response->assertStatus(200);
    }
}
