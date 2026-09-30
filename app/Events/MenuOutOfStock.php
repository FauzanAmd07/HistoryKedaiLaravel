<?php

namespace App\Events;

use App\Models\Menu;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenuOutOfStock
{
    use Dispatchable, SerializesModels;

    public function __construct(public Menu $menu) {}
}
