<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KaryawanTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_karyawan(): void
    {
        $admin = User::factory()->create(['jabatan' => 'Admin']);

        $data = [
            'nama'     => 'Staf Kasir Baru',
            'username' => 'kasirbaru',
            'password' => 'secret123',
            'jabatan'  => 'Kasir',
        ];

        $response = $this->actingAs($admin)->post(route('karyawan.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['username' => 'kasirbaru']);
    }
}
