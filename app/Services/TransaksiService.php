<?php

namespace App\Services;

use App\Contracts\TransaksiRepositoryInterface;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiService
{
    public function __construct(
        protected TransaksiRepositoryInterface $transaksiRepo
    ) {}

    public function processCheckout(string $namaPelanggan, string $metodeBayar, float $totalHarga, array $items): Transaksi
    {
        return DB::transaction(function () use ($namaPelanggan, $metodeBayar, $totalHarga, $items) {
            $pelanggan = Pelanggan::create(['nama_pelanggan' => $namaPelanggan]);

            $transaksi = $this->transaksiRepo->create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_karyawan'  => 1,
                'tanggal'      => now(),
                'total_harga'  => $totalHarga,
                'status'       => 'Baru Masuk',
                'metode_bayar' => $metodeBayar,
            ]);

            foreach ($items as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_menu'      => $item['id'],
                    'jumlah'       => $item['qty'],
                    'subtotal'     => $item['price'] * $item['qty'],
                ]);
            }

            return $transaksi;
        });
    }
}
