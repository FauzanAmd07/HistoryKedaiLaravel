<?php

namespace App\Traits;

use App\Helpers\CurrencyHelper;

trait HasRupiahFormat
{
    /**
     * Format harga attribute to Rupiah currency string.
     */
    public function getHargaFormattedAttribute(): string
    {
        return CurrencyHelper::formatRupiah($this->harga ?? $this->total_harga ?? 0);
    }
}
