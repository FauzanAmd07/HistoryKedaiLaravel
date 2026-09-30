<?php

namespace App\ValueObjects;

class OrderStatus
{
    public const BARU_MASUK = 'Baru Masuk';
    public const SEDANG_DIPROSES = 'Sedang Diproses';
    public const SELESAI = 'Selesai';
    public const BATAL = 'Batal';

    public static function all(): array
    {
        return [
            self::BARU_MASUK,
            self::SEDANG_DIPROSES,
            self::SELESAI,
            self::BATAL,
        ];
    }
}
