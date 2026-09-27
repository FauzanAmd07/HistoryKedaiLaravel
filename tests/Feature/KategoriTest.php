<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_kategori_list(): void
    {
        $user = User::factory()->create(['jabatan' => 'Admin']);
        Kategori::factory()->count(2)->create();

        $response = $this->actingAs($user)->get(route('kategori.index'));

        $response->assertStatus(200);
    }

    public function test_user_can_create_kategori(): void
    {
        $user = User::factory()->create(['jabatan' => 'Admin']);

        $data = [
            'nama_kategori'   => 'Minuman Dingin',
            'status_kategori' => 'Aktif',
        ];

        $response = $this->actingAs($user)->post(route('kategori.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('kategori', [
            'nama_kategori' => 'Minuman Dingin',
        ]);
    }
}
