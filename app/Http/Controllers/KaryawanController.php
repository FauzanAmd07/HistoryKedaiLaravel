<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = User::where('status_karyawan', 'Aktif')->orderByDesc('id_karyawan')->get();
        return view('dashboard.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('dashboard.karyawan.create');
    }

    public function store(StoreKaryawanRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['status_karyawan'] = 'Aktif';

        User::create($data);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit(User $karyawan)
    {
        return view('dashboard.karyawan.edit', compact('karyawan'));
    }

    public function update(UpdateKaryawanRequest $request, User $karyawan)
    {
        $data = $request->only('nama', 'username', 'jabatan');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $karyawan->update($data);
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    public function destroy(User $karyawan)
    {
        $karyawan->update(['status_karyawan' => 'Tidak Aktif']);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dinonaktifkan!');
    }
}
