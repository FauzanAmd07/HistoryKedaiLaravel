<?php

namespace App\Observers;

use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class MenuObserver
{
    public function created(Menu $menu): void
    {
        Log::info("Menu baru ditambahkan: {$menu->nama_menu} (ID: {$menu->id_menu})");
    }

    public function updated(Menu $menu): void
    {
        Log::info("Menu diperbarui: {$menu->nama_menu} (ID: {$menu->id_menu})");
    }
}
