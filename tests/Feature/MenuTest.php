<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_menu_list(): void
    {
        $user = User::factory()->create(['jabatan' => 'Admin']);
        $kategori = Kategori::factory()->create();
        Menu::factory()->count(3)->create(['id_kategori' => $kategori->id_kategori]);

        $response = $this->actingAs($user)->get(route('menu.index'));

        $response->assertStatus(200);
    }

    public function test_user_can_create_new_menu(): void
    {
        $user = User::factory()->create(['jabatan' => 'Admin']);
        $kategori = Kategori::factory()->create();

        $menuData = [
            'id_kategori' => $kategori->id_kategori,
            'nama_menu'   => 'Kopi Espresso',
            'harga'       => 25000,
            'deskripsi'   => 'Kopi hitam murni nikmat',
            'status_menu' => 'Tersedia',
        ];

        $response = $this->actingAs($user)->post(route('menu.store'), $menuData);

        $response->assertRedirect();
        $this->assertDatabaseHas('menu', [
            'nama_menu' => 'Kopi Espresso',
        ]);
    }
}
