<?php

namespace App\DTOs;

class CreateMenuDTO
{
    public function __construct(
        public readonly int $idKategori,
        public readonly string $namaMenu,
        public readonly float $harga,
        public readonly ?string $deskripsi = null
    ) {}
}
