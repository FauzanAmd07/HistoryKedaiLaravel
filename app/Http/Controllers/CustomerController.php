<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')
            ->with('menusAktif')
            ->get();

        $menus = Menu::where('status_menu', 'Tersedia')
            ->with('kategori')
            ->orderBy('nama_menu')
            ->get();

        $bestsellers = Menu::where('status_menu', 'Tersedia')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('customer.index', compact('kategoris', 'menus', 'bestsellers'));
    }

    public function keranjang()
    {
        return view('customer.keranjang');
    }

    public function checkout()
    {
        return view('customer.checkout');
    }

    public function prosesPesanan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'metode_bayar'   => 'required|in:Tunai,QRIS',
            'pesanan_json'   => 'required|json',
            'total_harga'    => 'required|numeric|min:0',
        ]);

        $pesanan = json_decode($request->pesanan_json, true);

        if (empty($pesanan)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            // 1. Buat pelanggan
            $pelanggan = Pelanggan::create(['nama' => $request->nama_pelanggan]);

            // 2. Buat transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_karyawan'  => 1, // sistem
                'tanggal'      => now('Asia/Makassar'),
                'total_harga'  => $request->total_harga,
                'status'       => 'Baru Masuk',
                'metode_bayar' => $request->metode_bayar,
            ]);

            // 3. Simpan detail pesanan
            foreach ($pesanan as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_menu'      => $item['id'],
                    'jumlah'       => $item['qty'],
                    'subtotal'     => $item['price'] * $item['qty'],
                ]);
            }

            DB::commit();
            return view('customer.sukses', compact('transaksi', 'pelanggan'))
                ->with('clear_cart', true);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Pesanan gagal. Silakan coba lagi.');
        }
    }
}
