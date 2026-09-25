<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Makassar');

        // Statistik
        $pendapatanBulanIni = Transaksi::selesai()->bulanIni()->sum('total_harga');
        $jumlahPesananBaru  = Transaksi::where('status', 'Baru Masuk')->count();
        $jumlahTransaksiBulanIni = Transaksi::selesai()->bulanIni()->count();

        $menuTerlaris = DetailTransaksi::select('id_menu', DB::raw('SUM(jumlah) as total_terjual'))
            ->whereHas('transaksi', fn($q) => $q->selesai()->bulanIni())
            ->with('menu')
            ->groupBy('id_menu')
            ->orderByDesc('total_terjual')
            ->first();

        $namaMenuTerlaris = $menuTerlaris?->menu?->nama_menu ?? 'Belum ada';

        $terjualBulan = DetailTransaksi::whereHas('transaksi', fn($q) => $q->selesai()->bulanIni())->sum('jumlah');
        $terjualTahun = DetailTransaksi::whereHas('transaksi', fn($q) => $q->selesai()->whereYear('tanggal', now()->year))->sum('jumlah');

        // Grafik mingguan (7 hari terakhir)
        $dataMingguan = Transaksi::selesai()
            ->where('tanggal', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(tanggal) as tgl, SUM(total_harga) as total')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->pluck('total', 'tgl');

        // Grafik harian (bulan ini)
        $dataHarian = Transaksi::selesai()->bulanIni()
            ->selectRaw('DAY(tanggal) as tanggal, SUM(total_harga) as total')
            ->groupBy(DB::raw('DAY(tanggal)'))
            ->get();

        // Grafik bulanan (tahun ini)
        $dataBulanan = Transaksi::selesai()
            ->whereYear('tanggal', now()->year)
            ->selectRaw('MONTH(tanggal) as bulan, SUM(total_harga) as total')
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->get();

        return view('dashboard.index', compact(
            'pendapatanBulanIni', 'jumlahPesananBaru', 'jumlahTransaksiBulanIni',
            'namaMenuTerlaris', 'terjualBulan', 'terjualTahun',
            'dataMingguan', 'dataHarian', 'dataBulanan'
        ));
    }
}
