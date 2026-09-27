<?php

namespace Tests\Unit;

use App\Models\Transaksi;
use Tests\TestCase;

class TransaksiModelTest extends TestCase
{
    public function test_transaksi_casts_total_harga_to_decimal(): void
    {
        $transaksi = new Transaksi(['total_harga' => '50000']);

        $this->assertEquals('50000.00', $transaksi->total_harga);
    }
}
