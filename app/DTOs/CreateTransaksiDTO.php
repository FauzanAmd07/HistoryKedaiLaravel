<?php

namespace App\DTOs;

class CreateTransaksiDTO
{
    public function __construct(
        public readonly string $namaPelanggan,
        public readonly string $metodeBayar,
        public readonly float $totalHarga,
        public readonly array $items
    ) {}
}
