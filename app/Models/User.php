<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama', 'username', 'password', 'jabatan', 'status_karyawan',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_karyawan', 'id_karyawan');
    }

    public function isPemilik(): bool { return $this->jabatan === 'Pemilik'; }
    public function isAdmin(): bool   { return $this->jabatan === 'Admin'; }
    public function isKasir(): bool   { return $this->jabatan === 'Kasir'; }
}
