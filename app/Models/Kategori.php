<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'status_kategori'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kategori', 'id_kategori');
    }

    public function menusAktif()
    {
        return $this->menus()->where('status_menu', 'Tersedia');
    }
}
