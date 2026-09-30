<?php

namespace App\Repositories;

use App\Contracts\TransaksiRepositoryInterface;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Collection;

class TransaksiRepository implements TransaksiRepositoryInterface
{
    public function getActiveOrders(): Collection
    {
        return Transaksi::whereIn('status', ['Baru Masuk', 'Sedang Diproses'])
            ->with(['pelanggan', 'details.menu'])
            ->orderBy('tanggal')
            ->get();
    }

    public function findById(int $id): ?Transaksi
    {
        return Transaksi::with(['pelanggan', 'karyawan', 'details.menu'])->find($id);
    }

    public function create(array $data): Transaksi
    {
        return Transaksi::create($data);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $transaksi = $this->findById($id);
        return $transaksi ? $transaksi->update(['status' => $status]) : false;
    }
}
