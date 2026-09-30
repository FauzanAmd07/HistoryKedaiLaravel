<?php

namespace App\Services;

use App\Models\Transaksi;
use Carbon\Carbon;

class ReportService
{
    public function getMonthlyRevenue(int $year, int $month): float
    {
        return (float) Transaksi::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->where('status', 'Selesai')
            ->sum('total_harga');
    }

    public function getTodayTotalOrders(): int
    {
        return Transaksi::whereDate('tanggal', Carbon::today())->count();
    }
}
