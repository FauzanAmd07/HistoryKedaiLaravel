<?php

namespace App\ValueObjects;

use App\Helpers\CurrencyHelper;

class Money
{
    public function __construct(public readonly float $amount) {}

    public function format(): string
    {
        return CurrencyHelper::formatRupiah($this->amount);
    }
}
