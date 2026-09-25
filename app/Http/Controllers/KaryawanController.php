<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6',
            'jabatan'  => 'required|in:Pemilik,Admin,Kasir',
        ]);

        User::create([
            'nama'            => $request->nama,
            'username'        => $request->username,
            'password'        => Hash::make($request->password),
            'jabatan'         => $request->jabatan,
            'status_karyawan' => 'Aktif',
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit(User $karyawan)
    {
        return view('dashboard.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, User $karyawan)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $karyawan->id_karyawan . ',id_karyawan',
            'jabatan'  => 'required|in:Pemilik,Admin,Kasir',
            'password' => 'nullable|string|min:6',
        ]);

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
