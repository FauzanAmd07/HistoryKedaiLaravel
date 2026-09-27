<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format Carbon/string date to Indonesian long date format.
     * Example: 27 September 2026
     *
     * @param string|\DateTimeInterface $date
     * @return string
     */
    public static function formatIndonesianDate($date): string
    {
        return Carbon::parse($date)->locale('id')->translatedFormat('d F Y');
    }
}
