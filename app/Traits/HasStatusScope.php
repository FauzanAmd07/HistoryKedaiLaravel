<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasStatusScope
{
    /**
     * Scope query to active records.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status_kategori', 'Aktif')
            ->orWhere('status_menu', 'Tersedia')
            ->orWhere('status_karyawan', 'Aktif');
    }
}
