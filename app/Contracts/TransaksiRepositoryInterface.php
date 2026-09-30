<?php

namespace App\Contracts;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Collection;

interface TransaksiRepositoryInterface
{
    public function getActiveOrders(): Collection;
    public function findById(int $id): ?Transaksi;
    public function create(array $data): Transaksi;
    public function updateStatus(int $id, string $status): bool;
}
