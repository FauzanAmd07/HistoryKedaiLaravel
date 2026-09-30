<?php

namespace App\Listeners;

use App\Events\TransaksiCreated;
use Illuminate\Support\Facades\Log;

class SendTransaksiNotification
{
    public function handle(TransaksiCreated $event): void
    {
        Log::info("New order notification sent for Order ID: {$event->transaksi->id_transaksi}");
    }
}
