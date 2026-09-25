<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function daftarPesanan()
    {
        $pesanans = Transaksi::whereIn('status', ['Baru Masuk', 'Sedang Diproses'])
            ->with('pelanggan')
            ->orderBy('tanggal')
            ->get();
        return view('dashboard.transaksi.daftar', compact('pesanans'));
    }

    public function riwayat()
    {
        $transaksis = Transaksi::with('pelanggan', 'karyawan')
            ->orderByDesc('tanggal')
            ->paginate(20);
        return view('dashboard.transaksi.riwayat', compact('transaksis'));
    }

    public function detail(Transaksi $transaksi)
    {
        $transaksi->load('pelanggan', 'karyawan', 'details.menu');
        return view('dashboard.transaksi.detail', compact('transaksi'));
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate(['status' => 'required|in:Baru Masuk,Sedang Diproses,Selesai,Batal']);

        if ($transaksi->status === 'Selesai' || $transaksi->status === 'Batal') {
            return back()->with('error', 'Status tidak dapat diubah.');
        }

        $transaksi->update(['status' => $request->status]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'status' => $request->status]);
        }

        return back()->with('success', 'Status pesanan diperbarui!');
    }
}
