<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')
            ->orderByDesc('id_kategori')
            ->get();

        return view('dashboard.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('dashboard.kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        Kategori::create($request->validated());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
        ]);

        $kategori->update(['nama_kategori' => $request->nama_kategori]);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->update(['status_kategori' => 'Diarsipkan']);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diarsipkan!');
    }
}
