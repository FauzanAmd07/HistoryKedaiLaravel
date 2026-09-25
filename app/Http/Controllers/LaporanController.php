<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('dashboard.laporan.index');
    }

    public function exportCsv(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));
        [$tahun, $bln] = explode('-', $bulan);

        $transaksis = Transaksi::selesai()
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bln)
            ->with('pelanggan', 'details.menu')
            ->orderBy('tanggal')
            ->get();

        $filename = 'laporan_' . $bulan . '.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function () use ($transaksis) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Transaksi', 'Tanggal', 'Nama Pelanggan', 'Menu', 'Jumlah', 'Subtotal', 'Total', 'Metode Bayar']);
            foreach ($transaksis as $t) {
                foreach ($t->details as $d) {
                    fputcsv($file, [
                        $t->id_transaksi,
                        $t->tanggal->format('d/m/Y H:i'),
                        $t->pelanggan->nama,
                        $d->menu->nama_menu,
                        $d->jumlah,
                        $d->subtotal,
                        $t->total_harga,
                        $t->metode_bayar,
                    ]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
