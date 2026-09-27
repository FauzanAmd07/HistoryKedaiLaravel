<?php

namespace Tests\Unit;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasStatusScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_kategori_model_can_query_active(): void
    {
        Kategori::factory()->create(['status_kategori' => 'Aktif']);

        $this->assertEquals(1, Kategori::count());
    }
}
