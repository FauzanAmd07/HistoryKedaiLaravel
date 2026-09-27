<?php

namespace Tests\Unit;

use App\Helpers\CurrencyHelper;
use PHPUnit\Framework\TestCase;

class CurrencyHelperTest extends TestCase
{
    public function test_format_rupiah_with_prefix(): void
    {
        $result = CurrencyHelper::formatRupiah(25000);
        $this->assertEquals('Rp 25.000', $result);
    }

    public function test_format_rupiah_without_prefix(): void
    {
        $result = CurrencyHelper::formatRupiah(50000, false);
        $this->assertEquals('50.000', $result);
    }
}
