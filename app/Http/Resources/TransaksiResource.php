<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_transaksi' => $this->id_transaksi,
            'tanggal'      => $this->tanggal->toIso8601String(),
            'total_harga'  => (float) $this->total_harga,
            'status'       => $this->status,
            'metode_bayar' => $this->metode_bayar,
        ];
    }
}
