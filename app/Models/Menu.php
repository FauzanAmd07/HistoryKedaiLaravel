<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = ['id_kategori', 'nama_menu', 'harga', 'gambar', 'deskripsi', 'status_menu'];

    protected $casts = ['harga' => 'decimal:2'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_menu', 'id_menu');
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar ? asset('storage/gambar/' . $this->gambar) : asset('images/default-menu.png');
    }
}
