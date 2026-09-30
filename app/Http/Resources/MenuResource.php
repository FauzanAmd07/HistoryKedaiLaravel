<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_menu'     => $this->id_menu,
            'nama_menu'   => $this->nama_menu,
            'harga'       => (float) $this->harga,
            'harga_rp'    => 'Rp ' . number_format($this->harga, 0, ',', '.'),
            'status_menu' => $this->status_menu,
            'gambar_url'  => $this->gambar_url,
            'kategori'    => new KategoriResource($this->whenLoaded('kategori')),
        ];
    }
}
