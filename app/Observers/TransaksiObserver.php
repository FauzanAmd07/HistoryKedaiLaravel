<?php

namespace App\Observers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class TransaksiObserver
{
    public function created(Transaksi $transaksi): void
    {
        Log::info("Transaksi baru dibuat #{$transaksi->id_transaksi} dengan total Rp {$transaksi->total_harga}");
    }
}
