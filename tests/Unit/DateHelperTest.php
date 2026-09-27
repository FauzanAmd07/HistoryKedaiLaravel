<?php

namespace Tests\Unit;

use App\Helpers\DateHelper;
use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{
    public function test_format_indonesian_date(): void
    {
        $formatted = DateHelper::formatIndonesianDate('2026-09-27');
        $this->assertStringContainsString('September', $formatted);
    }
}
