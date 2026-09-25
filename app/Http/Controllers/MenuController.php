<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('status_menu', 'Tersedia')->with('kategori')->orderByDesc('id_menu')->get();
        return view('dashboard.menu.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')->get();
        return view('dashboard.menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu'    => 'required|string|max:100',
            'id_kategori'  => 'required|exists:kategori,id_kategori',
            'harga'        => 'required|numeric|min:0',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
            $data['gambar'] = basename($data['gambar']);
        }

        Menu::create($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')->get();
        return view('dashboard.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama_menu'   => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) Storage::disk('public')->delete('gambar/' . $menu->gambar);
            $data['gambar'] = basename($request->file('gambar')->store('gambar', 'public'));
        }

        $menu->update($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $menu->update(['status_menu' => 'Diarsipkan']);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diarsipkan!');
    }
}
