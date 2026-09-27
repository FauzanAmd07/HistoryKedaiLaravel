<?php

namespace Tests\Unit;

use App\Models\Menu;
use Tests\TestCase;

class MenuModelTest extends TestCase
{
    public function test_menu_returns_default_image_url_when_null(): void
    {
        $menu = new Menu(['gambar' => null]);

        $this->assertStringContainsString('default-menu.png', $menu->gambar_url);
    }
}
