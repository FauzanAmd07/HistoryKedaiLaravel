<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Collection;

class SalesReportExport
{
    public function collection(): Collection
    {
        return Transaksi::with('pelanggan')->where('status', 'Selesai')->get();
    }
}
