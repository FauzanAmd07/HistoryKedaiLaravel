<?php

namespace App\Listeners;

use App\Events\MenuOutOfStock;
use Illuminate\Support\Facades\Log;

class NotifyAdminOutOfStock
{
    public function handle(MenuOutOfStock $event): void
    {
        Log::warning("Menu {$event->menu->nama_menu} is out of stock!");
    }
}
