<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'owner'],
            [
                'nama' => 'Pemilik Kedai',
                'password' => Hash::make('password123'),
                'jabatan' => 'Pemilik',
                'status_karyawan' => 'Aktif',
            ]
        );
    }
}
