<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Format number to Indonesian Rupiah currency string.
     *
     * @param float|int $amount
     * @param bool $withPrefix
     * @return string
     */
    public static function formatRupiah($amount, bool $withPrefix = true): string
    {
        $formatted = number_format($amount, 0, ',', '.');
        return $withPrefix ? 'Rp ' . $formatted : $formatted;
    }
}
