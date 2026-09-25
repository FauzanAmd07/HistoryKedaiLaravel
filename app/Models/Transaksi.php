<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_pelanggan', 'id_karyawan', 'tanggal', 'total_harga', 'status', 'metode_bayar',
    ];

    protected $casts = [
        'tanggal'     => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id_karyawan');
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year);
    }
}
